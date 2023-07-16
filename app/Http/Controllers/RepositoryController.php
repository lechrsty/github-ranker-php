<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Repository;
use Illuminate\Http\Request;

class RepositoryController extends Controller
{
    public function fetch()
    {
        /**
         * Retrieve and display GitHub's most starred PHP repositories in descending order.
         */

         // Set the GitHub API token
        $token = env('GITHUB_API_TOKEN');

        // Create a new GuzzleHttp client
        $client = new Client();

        // Send a GET request to the GitHub API to fetch the repositories
        $response = $client->get('https://api.github.com/search/repositories', [
            'query' => [
                'q' => 'language:php',
                'sort' => 'stars',
                'order' => 'desc',
            ],
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/vnd.github.v3+json',
            ],
        ]);

        // Decode the response body and store the data in a variable
        $data = json_decode($response->getBody(), true);

        // Clear the existing data in the 'repositories' table
        Repository::truncate();

        // For each repository, create a new instance of the 'Repository' model and save it to the database
        foreach ($data['items'] as $repository) {
            $repo = new Repository;
            $repo->repository_id = $repository['id'];
            $repo->name = $repository['name'];
            $repo->url = $repository['html_url'];
            $repo->created_date = date('Y-m-d H:i:s', strtotime($repository['created_at']));
            $repo->last_push_date = date('Y-m-d H:i:s', strtotime($repository['pushed_at']));
            $repo->description = $repository['description'];
            $repo->stars = $repository['stargazers_count'];
            $repo->save();
        }

        // Retrieve the repositories from the database
        $repositories = Repository::all();

        // Pass repositories to the Blade view and return the view
        return view('pages.repositories', ['repositories' => $repositories]);
    }

    public function show($id)
    {
        /**
         * Display repository details view.
         */

        // Locate the repository by its ID
        $repository = Repository::findOrFail($id);
    
        // Return the 'repository-details' view and pass the 'repository' variable to it
        return view('pages.repository-details', compact('repository'));
    }

    public function refresh()
    {
        /**
         * Fetch the latest repositories from GitHub and update the database.
         */
    
        // Clear the existing data in the repositories table
        Repository::truncate();
    
        // Fetch the latest repositories and save them to the database
        $this->fetch();
    
        // Redirect to the same page after the refresh process is completed
        return redirect()->route('repositories');
    }
}
