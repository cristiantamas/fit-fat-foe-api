<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest {
    public function rules (): array
    {
        if($this->route())
        {
            return $this->getRouteRules()[$this->route()->getName()] ?? [];
        }

        return [];
    }

    private function getRouteRules (): array
    {
        $loginRules = [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ];

        $registerRules = [
            'name' => 'required|string|max:100',
            'surname' => 'required|string|max:100',
            'email' => 'required|string|email|max:75',
            'password' => 'required|string|min:8',
            'is_admin' => 'sometimes|required|boolean',
            'is_trainer' => 'sometimes|required|boolean',
            'photo' => 'sometimes|required|string',
            'description' => 'sometimes|required|string|max:500'
        ];

        return [
            'fit-fat-foe::login' => $loginRules,
            'fit-fat-foe::register' => $registerRules,
        ];
    }
}
