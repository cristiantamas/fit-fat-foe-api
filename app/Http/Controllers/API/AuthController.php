<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function __construct (private AuthRequest $authRequest) {}

    public function register (): JsonResponse
    {
        $user = User::create([
                'name' => $this->authRequest->validated()['name'],
                'surname' => $this->authRequest->validated()['surname'],
                'email' => $this->authRequest->validated()['email'],
                'password' => Hash::make($this->authRequest->validated()['password'])
        ]);

        $token = $this->getToken($user);

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
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
