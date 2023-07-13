<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Repository;

class RepositoryController extends Controller
{
    public function fetch()
    {
        /**
         * Retrieve and display GitHub's most starred PHP repositories in descending order.
         */

        $token = env('GITHUB_API_TOKEN');
        $client = new Client();

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

        $repositories = json_decode($response->getBody(), true);

        // For each repository, create a new instance of the 'Repository' model and save it to the database

        foreach ($repositories['items'] as $repository) {
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

        // Process and return the retrieved repositories 
        return $repositories;
    }

    public function refresh()
    {
        /**
         * Fetch the latest repositories from GitHub and update the database
         */

        $this->fetch();

        // Return a response indicating that the refresh process was successful
        return response()->json(['message' => 'Database refreshed successfully']);
    }
}
