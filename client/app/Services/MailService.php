<?php

namespace App\Services;

use App\Models\Mail;
use App\Models\MailActive;
use App\Models\MailContent;
use Illuminate\Support\Facades\DB;

class MailService
{
    public function mail_create(int $user_id, string $subject, string $body)
    {
        DB::transaction(function() use ($user_id, $subject, $body) {
            $mail = Mail::create([
                'user_id' => $user_id,
            ]);
            MailContent::create([
                'mail_id' => $mail->mail_id,
                'subject' => $subject,
                'body' => $body
            ]);
            MailActive::create([
                'mail_id' => $mail->mail_id,
            ]);
        });
    }
}
