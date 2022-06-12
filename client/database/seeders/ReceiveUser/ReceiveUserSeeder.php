<?php

namespace Database\Seeders\ReceiveUser;

use App\Models\ReceiveUser\Eloquent\ReceiveUser;
use Illuminate\Database\Seeder;

class ReceiveUserSeeder extends Seeder
{
    public function run()
    {
        ReceiveUser::factory(10)
                    ->create();
    }
}
