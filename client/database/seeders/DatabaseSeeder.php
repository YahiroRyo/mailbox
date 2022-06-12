<?php

namespace Database\Seeders;

use Database\Seeders\Mail\MailSeeder;
use Database\Seeders\ReceiveUser\ReceiveUserSeeder;
use Database\Seeders\User\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ReceiveUserSeeder::class,
            MailSeeder::class,
        ]);
    }
}
