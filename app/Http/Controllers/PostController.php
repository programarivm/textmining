<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function relevance(string $keyword, string $userId = null)
    {
        $response = Http::get(env('FAKE_API_URL').'/posts');

        $body = $response->body();

        $posts = json_decode($body);

        $relevance = $this->postRepository->relevance($keyword, $posts, $userId);

        echo $relevance;

        exit;
    }
}
