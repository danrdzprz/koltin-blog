<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository implements CommentRepositoryInterface
{
    public function getAllComments(): LengthAwarePaginator
    {
        return Comment::paginate(15);
    }

    public function getAllCommentsByDate(string $startDate, string $endDate): Collection
    {
        $start = Carbon::parse($startDate)->startOfday();
        $end = Carbon::parse($endDate)->endOfday();

        return Comment::whereBetween('comments.created_at', [$start->format('Y-m-d H:i:s'), $end->format('Y-m-d H:i:s')])->report()->get();
    }

    public function getAllCommentsByAuthor(int $UserId): Collection
    {
        return Comment::where(['user_id' => $UserId])->orderBy('created_at', 'desc')->with('post')->get();
    }

    public function getAllCommentsByPost(int $PostId): Collection
    {
        return Comment::with('user')->where(['post_id' => $PostId])->orderBy('created_at', 'desc')->get();
    }

    public function createComment(array $CommentDetails): Comment
    {
        return Comment::create($CommentDetails);
    }
}
