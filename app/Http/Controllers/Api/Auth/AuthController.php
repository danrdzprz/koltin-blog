<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    ) {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $payloadData = $request->validated();
        if (!Auth::attempt($payloadData)) {
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized'],
            ], 401);
        }

        $user = $this->userRepository->getUserByEmal($payloadData['email']);

        return response()->json([
            'status' => true,
            'messagge' => 'User Logged in successfully',
            'token' => $user->createToken('API_TOKEN')->plainTextToken,
        ], 200);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'status' => true,
            'messagge' => 'User Logged out successfully',
        ], 200);
    }
}
