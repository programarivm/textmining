<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function csv(string $keyword)
    {
        $response = Http::get(env('FAKE_API_URL').'/posts');

        switch ($response->status()) {
            case 200:
                $posts = json_decode($response->body());
                $csv = $this->postRepository->csv($keyword, $posts);

                // TODO

                echo $csv;

                exit;

            default:
                return response()->json([
                        'message' => 'Whoops! Something went wrong, please try again later.'
                    ], Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }

    public function relevance(string $keyword, string $userId = null)
    {
        $response = Http::get(env('FAKE_API_URL').'/posts');

        switch ($response->status()) {
            case 200:
                $posts = json_decode($response->body());
                $relevance = $this->postRepository->relevance($keyword, $posts, $userId);
                return response()->json([
                        $keyword => $relevance,
                    ], Response::HTTP_OK
                );
            default:
                return response()->json([
                        'message' => 'Whoops! Something went wrong, please try again later.'
                    ], Response::HTTP_INTERNAL_SERVER_ERROR
                );
        }
    }
}
