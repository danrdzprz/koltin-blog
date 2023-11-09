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
    /**
     *  @OA\Post(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     security={{"bearerAuth":{}}}, *
     *     summary="Register a new comment",
     *
     *      @OA\RequestBody(
     *      required=true,
     *      description="Provide All Info Below",
     *
     *      @OA\JsonContent(
     *          required={"post_id","text"},
     *
     *          @OA\Property(property="post_id", type="number", format="text", example=1),
     *          @OA\Property(property="text", type="text", format="text", example="new comment"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Comment registered successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="Comment created successfully")
     *        )
     *     ),
     *
     *   @OA\Response(
     *    response=422,
     *    description="Comment Not register",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="code", type="number", example=422),
     *       @OA\Property(property="message", type="object", example="{text:[required]}")
     *        )
     *     ),
     *
     *   @OA\Response(
     *    response=401,
     *    description="Required authentication",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="code", type="number", example=401),
     *       @OA\Property(property="message", type="object", example="Unauthenticated")
     *        )
     *      )
     *    )
     * )
     */
    public function store(CommentCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $this->commentRepository->createComment($data);

        return response()->json([
            'messagge' => __('api.comments.create.success'),
        ], JsonResponse::HTTP_CREATED);
    }
}
