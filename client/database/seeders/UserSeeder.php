<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserActive;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory(10)
            ->create()
            ->each(function($user) {
                UserActive::create(['user_id' => $user->user_id]);
            });
    }
}
