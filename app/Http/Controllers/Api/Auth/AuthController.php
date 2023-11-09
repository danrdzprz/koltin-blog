<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 * )
 */
class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
    }

    /**
     *  @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Login endpoint to get token and allow to create posts and comments",
     *
     *      @OA\RequestBody(
     *      required=true,
     *      description="Provide All Info Below",
     *
     *      @OA\JsonContent(
     *          required={"email","password"},
     *
     *          @OA\Property(property="email", type="string", format="text", example="email@test.com"),
     *          @OA\Property(property="password", type="string", format="text", example="12345678"),
     *          ),
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="User login successfully",
     *
     *          @OA\JsonContent(
     *
     *              @OA\Property(property="message", type="string", example="User Logged in successfully"),
     *              @OA\Property(property="token", type="string", example="QrCcHEPyOy66h7ibLWaZZ7I")
     *        )
     *     ),
     *
     *   @OA\Response(
     *    response=422,
     *    description="Bad request",
     *
     *    @OA\JsonContent(
     *
     *       @OA\Property(property="code", type="number", example=422),
     *       @OA\Property(property="message", type="object", example="{email:[required]}")
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
     *       @OA\Property(property="message", type="object", example="Unauthorized")
     *        )
     *      )
     *    )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $payloadData = $request->validated();
        if (!Auth::attempt($payloadData)) {
            return response()->json([
                'messagge' => __('api.auth.login.failure'),
            ], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user = $this->userRepository->getUserByEmal($payloadData['email']);

        return response()->json([
            'messagge' => __('api.auth.login.success'),
            'token' => $user->createToken('API_TOKEN')->plainTextToken,
        ], JsonResponse::HTTP_OK);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'messagge' => __('api.auth.logout.success'),
        ], JsonResponse::HTTP_OK);
    }
}
