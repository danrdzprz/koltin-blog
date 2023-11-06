<?php

namespace App\Interfaces;

use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface
{
    public function getAllPosts(int $total = 10): LengthAwarePaginator;

    public function getPostById(int $postId): Post;

    public function deletePost(int $postId): int;

    public function createPost(array $postDetails): Post;

    public function updatePost(int $postId, array $newDetails): int;
}
