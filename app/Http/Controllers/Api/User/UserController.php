<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupFormRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $_userRepository;
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
        $this->_userRepository = $userRepository;
    }

    
    /**
     * Display a listing of the resource.
     * 
     * @return LengthAwarePaginator
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
