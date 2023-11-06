<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAllComments(): LengthAwarePaginator
    {
        return Comment::paginate(15);
    }

    public function getAllCommentsByDate(string $startDate, string $endDate): array
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        return Comment::whereBetween('created_at', [$start, $end])->get()->toArray();
    }

    public function getAllCommentsByAuthor(int $UserId): array
    {
        return Comment::where(['user_id' => $UserId])->get()->toArray();
    }

    public function getAllCommentsByPost(int $PostId): array
    {
        return Comment::with('user')->where(['post_id' => $PostId])->get()->toArray();
    }

    public function createComment(array $CommentDetails): Comment
    {
        return Comment::create($CommentDetails);
    }
}
