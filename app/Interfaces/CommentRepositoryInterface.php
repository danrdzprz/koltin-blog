<?php

namespace App\Interfaces;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{
    public function getAllComments(): LengthAwarePaginator;

    public function getAllCommentsByDate(string $startDate, string $endDate): array;

    public function getAllCommentsByAuthor(int $UserId): array;

    public function getAllCommentsByPost(int $PostId): array;

    public function createComment(array $CommentDetails): Comment;
}
