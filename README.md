## About This Project

This simple project was created using the Laravel framework and styled with Bootstrap. It utilizes GitHub's API to retrieve and display the top 30 most-starred PHP repositories. Users are able to refresh the data, as well as view more details about each individual repository.
___

## Installation Instructions

1. Clone the repository to your local machine. 
2. Download and install Docker Desktop [here](https://www.docker.com/products/docker-desktop/). Once downloaded, open Docker Desktop and start the Docker Engine.
3. Generate a new GitHub personal access token [here](https://github.com/settings/tokens) and select the "repo" scope. Save this token for later.
4. Open up a terminal and navigate to your project's root folder. \
`cd /path/to/project`
5. Copy the .env.example file to .env \
`cp .env.example .env`
6. Install composer dependencies with Laravel sail \
`composer require laravel/sail --dev && php artisan sail:install`
7. After the command is finished running in your terminal, select [0] for MySQL to install MySQL 
8. Ensure that a docker-compose.yml file was created at the root of the project. If the file is created, run the following command to build and run the needed containers \
`COMPOSE_DOCKER_CLI_BUILD=1 DOCKER_BUILDKIT=1 ./vendor/bin/sail build`
9. Boot up the application using docker \
`./vendor/bin/sail up`
You can pass the `-d` flag to operate in detached mode to free up your terminal.
10. Generate an application key \
`./vendor/bin/sail artisan key:generate`
11. Ensure the database credentials in the .env file are configured like so:

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```
12. In your .env file, insert the GitHub personal access token you generated at the beginning \

```
GITHUB_API_TOKEN={enter token, without curly braces}
```
13. Run database migrations. \
`./vendor/bin/sail artisan migrate`
14. Install Bootstrap, Laravel UI, and npm dependencies. Do not replace any existing files with incoming ones. \
`composer require laravel/ui && php artisan ui bootstrap --auth && npm install`
`npm run dev`
15. Navigate to `localhost` in your browser of choice.
___

## Helpful Links
- [Laravel Documentation](https://laravel.com/docs/10.x)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
