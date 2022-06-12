<?php

namespace Database\Seeders\Mail;

use App\Models\Mail\Eloquent\Mail;
use App\Models\Mail\Eloquent\MailActive;
use App\Models\Mail\Eloquent\MailContent;
use App\Models\Mail\Eloquent\MailProfile;
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
                MailProfile::factory(1)
                        ->create([
                            'mail_id' => $mail->mail_id
                        ]);
            });
    }
}
