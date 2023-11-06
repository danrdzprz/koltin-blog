<?php

namespace App\Http\Controllers\Api\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PostRepositoryInterface $postRepository,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\LengthAwarePaginator
     */
    /**
     *  @OA\Get(
     *     path="/api/posts",
     *     tags={"Post"},
     *     summary="Paginated post list with user and post",
     *     security={{"bearerAuth":{}}}, *
     *
     *      @OA\Response(
     *          response=200,
     *          description="Author registered successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="current_page", type="number", example=1),
     *              @OA\Property(property="data", type="array",
     *
     *              @OA\Items(
     *
     *                  @OA\Property(property="id", type="number", example=1),
     *                  @OA\Property(property="title", type="string", example="example"),
     *                  @OA\Property(property="text", type="string", example="example"),
     *              )),
     *              @OA\Property(property="first_page_url", type="string", example="http://127.0.0.1/api/posts?page=1"),
     *              @OA\Property(property="from", type="number", example=1),
     *              @OA\Property(property="last_page", type="number", example=1),
     *              @OA\Property(property="last_page_url", type="string", example="http://127.0.0.1/api/posts?page=1"),
     *              @OA\Property(property="per_page", type="number", example=1),
     *              @OA\Property(property="prev_page_url", type="string", example="http://127.0.0.1/api/posts?page=1"),
     *              @OA\Property(property="to", type="number", example=1),
     *              @OA\Property(property="total", type="number", example=1),
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
     *     )
     *    )
     *  )
     */
    public function index(): LengthAwarePaginator
    {
        return $this->postRepository->getAllPosts();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $this->postRepository->createPost($data);

        return response()->json([
            'status' => true,
            'messagge' => 'Post created successfully',
        ]);
    }
}
