<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    public function relevance(string $keyword, array $posts, int $userId = null);
}
