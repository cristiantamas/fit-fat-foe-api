<?php

declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\User;

class UserRepository {

    public function getUser(int $userId): User
    {
        try{
            return User::findOrFail($userId);
        }
        catch (Exception $e) {
            throw new Exception('Could not get user');
        }

    }


    public function createUser(array $data): User
    {
        try{
            return User::create([
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
        }
        catch (Exception $e) {
            throw new Exception('Could not create user');
        }
    }
}
