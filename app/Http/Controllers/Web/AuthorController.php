<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\View\View;

class AuthorController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected CommentRepositoryInterface $commentRepository,
    ) {
    }

    /**
     * Display the specified resource.
     */
    public function show(int $author_id): View
    {
        $author = $this->userRepository->getUserById($author_id);

        $comments = $this->commentRepository->getAllCommentsByAuthor($author->id);

        return view('authors.index', ['author' => $author, 'comments' => $comments]);
    }
}
