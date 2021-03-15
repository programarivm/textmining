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

    public static function relevance(string $keyword, array $posts)
    {
        $result = 0;
        foreach ($posts as $post) {
            $result += self::count($post->title, $keyword) * 2 + self::count($post->body, $keyword);
        }

        return $result;
    }
}
