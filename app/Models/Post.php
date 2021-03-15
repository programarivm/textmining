<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    private static function count(string $haystack, string $needle)
    {
        $words = str_word_count($haystack, 1);
        $count = array_count_values($words);

        return $count[$needle] ?? 0;
    }

    public static function countAll(string $keyword, array $posts)
    {
        $result = 0;
        foreach ($posts as $post) {
            $result += self::count($post->title, $keyword) * 2 + self::count($post->body, $keyword);
        }

        return $result;
    }

    public static function countByUser(string $keyword, array $posts, int $userId = null)
    {
        $result = 0;
        foreach ($posts as $post) {
            if ($userId) {
                if ($post->userId == $userId) {
                    $result += self::count($post->title, $keyword) * 2 + self::count($post->body, $keyword);
                }
            }
        }

        return $result;
    }


    public static function relevance(string $keyword, array $posts, int $userId = null)
    {
        $userId ? $result = self::countByUser($keyword, $posts, $userId) : $result = self::countAll($keyword, $posts);

        return $result;
    }
}
