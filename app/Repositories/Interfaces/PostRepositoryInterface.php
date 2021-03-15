<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function csv(string $keyword, array $posts);

    public function relevance(string $keyword, array $posts, int $userId = null);
}
