<?php

namespace App\Interfaces;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{
    public function getAllComments(): LengthAwarePaginator;

    public function getAllCommentsByDate(string $startDate, string $endDate): Collection;

    public function getAllCommentsByAuthor(int $UserId): Collection;

    public function getAllCommentsByPost(int $PostId): Collection;

    public function createComment(array $CommentDetails): Comment;
}
