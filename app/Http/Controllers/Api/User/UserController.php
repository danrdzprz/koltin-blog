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
    #[OA\Get(path: '/api/posts')]
    #[OA\Response(response: 200, description: 'AOK')]
    #[OA\Response(response: 401, description: 'Not allowed')]
    public function index(): LengthAwarePaginator
    {
        return $this->userRepository->getAllUsers();
    }

    public function create(SignupFormRequest $request): JsonResponse
    {
        $this->userRepository->createUser($request->validated());

        return response()->json([
            'status' => true,
            'messagge' => 'User created successfully',
        ]);
    }
}
