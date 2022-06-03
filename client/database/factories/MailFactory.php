<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailFactory extends Factory
{
    public function definition()
    {
        $users = User::all()->toArray();
        return [
            'user_id' => $users[random_int(0, count($users) - 1)]['user_id']
        ];
    }
}
