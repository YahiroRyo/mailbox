<?php

namespace App\Services;

use App\Models\User\Eloquent\User;
use App\Models\User\Eloquent\UserActive;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function user_create(string $email, string $password)
    {
        DB::transaction(function() use ($email, $password) {
            $user = User::create([
                'email' => $email,
                'password' => Hash::make($password)
            ]);
            UserActive::create([
                'user_id' => $user->user_id
            ]);
        });
    }
}
