## Posting API

API to get statistics from posts.

### 1. Before You Begin

Build the Docker containers:

    $ docker-compose up --build

Find out your PHP container IP and run the built-in Laravel web server on port `8000`:

    $ docker exec -itu 1000:1000 posting_api_php_fpm php artisan serve --host=172.22.0.2 --port=8000
