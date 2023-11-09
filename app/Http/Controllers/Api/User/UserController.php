<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupFormRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    /**
     *  @OA\Get(
     *     path="/api/authors",
     *     tags={"Authors"},
     *     summary="Paginated authors list with comments and post",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="number of page to visit",
     *         required=false,
     *      ),
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
     *                  @OA\Property(property="name", type="string", example="example"),
     *                  @OA\Property(property="email", type="string", example="example"),
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
     *  )
     */
    public function index(): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers();
    }

    /**
     *  @OA\Post(
     *     path="/api/authors",
     *     tags={"Authors"},
     *     summary="Register a new author",
     *
     *      @OA\RequestBody(
     *      required=true,
     *      description="Provide All Info Below",
     *
     *      @OA\JsonContent(
     *          required={"email","name","password","password_confirmation"},
     *
     *          @OA\Property(property="name", type="string", format="text", example="Mario"),
     *          @OA\Property(property="email", type="email", format="text", example="mario@example.org"),
     *          @OA\Property(property="password", type="string", format="text", example="123467890"),
     *          @OA\Property(property="password_confirmation", type="string", format="text", example="123467890"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Author registered successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="error", type="string", example="false"),
     *              @OA\Property(property="message", type="string", example="Author registered successfully")
     *        )
     *     ),
     *
     *   @OA\Response(
     *    response=422,
     *    description="Author Not register",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="code", type="number", example=422),
     *       @OA\Property(property="message", type="object", example="message:{email:[required]}")
     *        )
     *     )
     * )
     */
    public function create(SignupFormRequest $request): JsonResponse
    {
        $this->userRepository->createUser($request->validated());

        return response()->json([
            'messagge' => __('api.authors.create.success'),
        ], JsonResponse::HTTP_CREATED);
    }
}
