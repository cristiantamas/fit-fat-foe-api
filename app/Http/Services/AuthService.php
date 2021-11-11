<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthService {

    public function __construct(private AuthRequest $authRequest, private UserRepository $userRepository)
    {
        $this->authRequest->replace($this->authRequest->validated());
    }

    public function login(): JsonResponse
    {
        if (!Auth::attempt($this->authRequest->validated())) {
            return $this->error('Credentials not match', 401);
        }

        $user = auth()->user();

        return response()->json([
            'token' => $this->getToken($user),
            'user' => $user
        ]);
    }

    public function register(): JsonResponse
    {
        $user = $this->userRepository->createUser($this->authRequest->all());

        $token = $this->getToken($user);

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Tokens Revoked'
        ]);
    }

    private function getToken(User $user): string
    {
        return $user->createToken('API Token')->plainTextToken;
    }
}
