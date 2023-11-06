<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PostRepositoryInterface $postRepository,
    ) {
    }

    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $posts = $this->postRepository->getAllPosts(5);

        return view('home', ['posts' => $posts]);
    }
}
