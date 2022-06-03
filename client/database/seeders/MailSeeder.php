<?php

namespace Database\Seeders;

use App\Models\Mail;
use App\Models\MailActive;
use App\Models\MailContent;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    public function run()
    {
        Mail::factory(1000)
            ->create()
            ->each(function($mail) {
                MailContent::factory(1)
                            ->create([
                                'mail_id' => $mail->mail_id
                            ]);
                MailActive::create([
                    'mail_id' => $mail->mail_id
                ]);
            });
    }
}
