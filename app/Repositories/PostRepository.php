<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    private function count(string $haystack, string $needle)
    {
        $words = str_word_count($haystack, 1);
        $count = array_count_values($words);

        return $count[$needle] ?? 0;
    }

    private function all(string $keyword, array $posts)
    {
        $result = 0;
        foreach ($posts as $post) {
            $result += $this->count($post->title, $keyword) * 2 + $this->count($post->body, $keyword);
        }

        return $result;
    }

    private function byUser(string $keyword, array $posts, int $userId = null)
    {
        $result = 0;
        foreach ($posts as $post) {
            if ($userId) {
                if ($post->userId == $userId) {
                    $result += $this->count($post->title, $keyword) * 2 + $this->count($post->body, $keyword);
                }
            }
        }

        return $result;
    }

    public function csv(string $keyword, array $posts)
    {
        $csv = '';
        $result = [];
        foreach ($posts as $post) {
            $relevance = $this->count($post->title, $keyword) * 2 + $this->count($post->body, $keyword);
            $result[] = [
                'user_id' => $post->userId,
                'post_title' => $post->title,
                'relevance' => $relevance,
            ];
        }
        
        $relevance = array_column($result, 'relevance');
        array_multisort($relevance, SORT_DESC, $result);

        foreach($result as $item) {
            $csv .= implode(",", $item) . PHP_EOL;
        }

        return $csv;
    }

    public function relevance(string $keyword, array $posts, int $userId = null)
    {
        $userId ? $result = $this->byUser($keyword, $posts, $userId) : $result = $this->all($keyword, $posts);

        return $result;
    }
}
