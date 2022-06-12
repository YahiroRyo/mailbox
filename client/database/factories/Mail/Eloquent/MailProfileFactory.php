<?php

namespace Database\Factories\Mail\Eloquent;

use App\Models\Mail\Eloquent\MailProfile;
use App\Models\ReceiveUser\Eloquent\ReceiveUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailProfileFactory extends Factory
{
    protected $model = MailProfile::class;

    public function definition()
    {
        $receive_users = ReceiveUser::all()->toArray();
        return [
            'receive_user_id' => $receive_users[random_int(0, count($receive_users) - 1)]['receive_user_id'],
            'mail_text_url' => $this->faker->url(),
            'mail_created_at' => Carbon::now(),
        ];
    }
}
