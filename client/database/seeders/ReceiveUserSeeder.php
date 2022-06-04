<?php

namespace Database\Seeders;

use App\Models\ReceiveUser;
use Illuminate\Database\Seeder;

class ReceiveUserSeeder extends Seeder
{
    public function run()
    {
        ReceiveUser::factory(10)
                    ->create();
    }
}
