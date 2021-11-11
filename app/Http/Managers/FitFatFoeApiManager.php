<?php

declare(strict_types=1);

namespace App\Http\Managers;

use App\Http\Repositories\UserRepository;
use App\Http\Services\AuthService;
use App\Http\Services\TokenService;

class FitFatFoeApiManager {

    public function getTokenService(): TokenService
    {
        return resolve(TokenService::class);
    }

    public function getAuthService(): AuthService
    {
        return resolve(AuthService::class);
    }

    public function getUserRepository(): UserRepository
    {
        return resolve(UserRepository::class);
    }
}
