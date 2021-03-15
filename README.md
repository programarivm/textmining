## Text-Mining API

API that works out statistical data from texts.

Clone the repo:

    $ git clone git@github.com:programarivm/textmining.git

### 1. Before You Begin

Create an `.env` file:

    $ cp .env.example .env

Build the Docker containers:

    $ docker-compose up --build

Install the dependencies:

    $ docker exec -itu 1000:1000 posting_api_php_fpm composer install

Find out your PHP container IP and run the built-in Laravel web server on port `8000`:

    $ docker exec -itu 1000:1000 posting_api_php_fpm php artisan serve --host=172.22.0.2 --port=8000

### API Endpoints

Endpoint | HTTP Verb | Description
-------- | --------- | -----------
`api/post/relevance/{keyword}/{user_id?}` | `GET` | Gets the keyword relevance as per the occurrences found in the posts' title and body
`api/post/csv/{keyword}` | `GET` | Builds a CSV file containing the keyword relevance by user

### Examples

Gets the relevance of the keyword `sunt` in all posts:

    $ curl http://172.18.0.2:8000/api/post/relevance/sunt
    $ {"sunt":37}

Gets the relevance of the keyword `sunt` in all posts with `user_id` equal to `1`:

    $ curl http://172.18.0.2:8000/api/post/relevance/sunt/1
    $ {"sunt":6}
