<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PostRepositoryInterface $postRepository,
    ) {
    }
}
