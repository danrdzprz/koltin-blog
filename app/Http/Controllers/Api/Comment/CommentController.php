<?php

namespace App\Http\Controllers\Api\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentCreateRequest;
use App\Interfaces\CommentRepositoryInterface;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected CommentRepositoryInterface $commentRepository,
    ) {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $this->commentRepository->createComment($data);

        return response()->json([
            'status' => true,
            'messagge' => 'Comment created successfully',
        ]);
    }
}
