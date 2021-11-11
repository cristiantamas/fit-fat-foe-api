<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Managers\FitFatFoeApiManager;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthService {

    public function __construct(private AuthRequest $authRequest, private FitFatFoeApiManager $apiManager)
    {
        $this->authRequest->replace($this->authRequest->validated());
    }

    public function login(): JsonResponse
    {
        if (!Auth::attempt($this->authRequest->validated())) {
            return $this->error('Credentials not match', 401);
        }

        $user = auth()->user();
        $token = $this->apiManager->getTokenService()->getTokenForUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function register(): JsonResponse
    {
        $user = $this->apiManager->getUserRepository()->createUser($this->authRequest->all());
        $token = $this->apiManager->getTokenService()->getTokenForUser($user);

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
}
