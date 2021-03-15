<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    public function relevance(Request $request)
    {
        $response = Http::get(env('FAKE_API_URL').'/posts');

        $body = $response->body();

        $posts = json_decode($body);

        $relevance = Post::relevance($posts);

        // TODO

        exit;
    }
}
