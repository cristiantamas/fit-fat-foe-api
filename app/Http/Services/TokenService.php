<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\User;

class TokenService {

    public function getTokenForUser(User $user): string
    {
        return $user->createToken('API Token')->plainTextToken;
    }
}
