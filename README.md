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
`api/post/csv/{keyword}` | `GET` | Downloads a CSV file containing the keyword relevance by user

### Examples

Gets the relevance of the keyword `sunt` in all posts:

    $ curl http://172.18.0.2:8000/api/post/relevance/sunt
    $ {"sunt":37}

Gets the relevance of the keyword `sunt` in all posts with `user_id` equal to `1`:

    $ curl http://172.18.0.2:8000/api/post/relevance/sunt/1
    $ {"sunt":6}

Downloads a CSV file containing a list of users ordered by keyword relevance in their posts:

    $ curl http://172.18.0.2:8000/api/post/csv/veritatis
    6,consequatur placeat omnis quisquam quia reprehenderit fugit veritatis facere,2
    7,repudiandae ea animi iusto,2
    8,quam voluptatibus rerum veritatis,2
    9,dolore veritatis porro provident adipisci blanditiis et sunt,2
    9,optio ipsam molestias necessitatibus occaecati facilis veritatis dolores aut,2
    9,tempora rem veritatis voluptas quo dolores vero,2
    1,optio molestias id quia eum,1
    2,doloribus ad provident suscipit at,1
    3,maxime id vitae nihil numquam,1
    5,laborum non sunt aut ut assumenda perspiciatis voluptas,1
    6,ut quo aut ducimus alias,1
    10,laboriosam dolor voluptates,1
    1,dolorem dolore est ipsam,0
