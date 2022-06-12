<?php

namespace Database\Factories\Mail\Eloquent;

use App\Models\Mail\Eloquent\Mail;
use App\Models\User\Eloquent\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailFactory extends Factory
{
    protected $model = Mail::class;

    public function definition()
    {
        $users = User::all()->toArray();
        return [
            'user_id' => $users[random_int(0, count($users) - 1)]['user_id']
        ];
    }
}
