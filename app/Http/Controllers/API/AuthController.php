<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function __construct (private AuthRequest $authRequest, private AuthService $authService) {}

    public function register (): JsonResponse
    {
        return $this->authService->register();
    }

    public function login(): JsonResponse
    {
        return $this->authService->login();
    }

    public function logout(): JsonResponse
    {
        return $this->authService->logout();
    }
}
