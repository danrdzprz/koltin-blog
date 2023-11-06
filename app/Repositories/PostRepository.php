<?php

namespace App\Repositories;

use App\Interfaces\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts(int $total = 10): LengthAwarePaginator
    {
        return Post::with('user', 'comments')->paginate($total);
    }

    public function getPostById(int $PostId): Post
    {
        return Post::findOrFail($PostId);
    }

    public function deletePost(int $PostId): int
    {
        return Post::destroy($PostId);
    }

    public function createPost(array $PostDetails): Post
    {
        return Post::create($PostDetails);
    }

    public function updatePost(int $PostId, array $newDetails): int
    {
        return Post::whereId($PostId)->update($newDetails);
    }
}
