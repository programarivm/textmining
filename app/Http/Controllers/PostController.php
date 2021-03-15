<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function relevance(Request $request)
    {
        $response = Http::get(env('FAKE_API_URL').'/posts');

        $body = $response->body();

        $arr = json_decode($body);

        // TODO

        print_r($arr);

        exit;
    }
}
