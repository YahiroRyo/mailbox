<?php

namespace App\Services;

use App\Models\Mail;
use App\Models\MailActive;
use App\Models\MailContent;
use App\Models\MailProfile;
use App\Models\ReceiveUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MailService
{
    public function mail_create(
        int $user_id,
        string $subject,
        string $body,
        ?string $cc,
        string $from_email,
        string $mail_text_url,
        string $mail_created_at,
    )
    {
        DB::transaction(function() use ($user_id, $subject, $body, $cc, $from_email, $mail_text_url, $mail_created_at) {
            $mail = Mail::create([
                'user_id' => $user_id,
            ]);
            MailContent::create([
                'mail_id' => $mail->mail_id,
                'subject' => $subject,
                'cc' => $cc,
                'body' => $body
            ]);
            MailActive::create([
                'mail_id' => $mail->mail_id,
            ]);
            $recive_user = ReceiveUser::updateOrCreate([
                'email' => $from_email,
            ]);
            MailProfile::create([
                'receive_user_id' => $recive_user->receive_user_id,
                'mail_text_url' => $mail_text_url,
                'mail_created_at' => new Carbon($mail_created_at),
            ]);
        });
    }
}
