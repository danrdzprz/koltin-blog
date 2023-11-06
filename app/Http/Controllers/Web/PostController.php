<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PostRepositoryInterface $postRepository,
        protected CommentRepositoryInterface $commentRepository,
    ) {
    }

    /**
     * Display the specified resource.
     */
    public function show(int $post_id): View
    {
        $post = $this->postRepository->getPostById($post_id);
        $comments = $this->commentRepository->getAllCommentsByPost($post_id);

        return view('posts.index', ['post' => $post, 'comments' => $comments]);
    }
}
