<?php

namespace App\Services;

use App\Models\Mail;
use App\Models\MailActive;
use App\Models\MailContent;
use App\Models\MailDelete;
use App\Models\MailProfile;
use App\Models\MailSend;
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
        string $name,
        string $from_email,
        string $mail_text_url,
        string $mail_created_at,
        bool $is_send
    )
    {
        DB::transaction(function() use ($user_id, $subject, $body, $cc, $from_email, $name, $mail_text_url, $mail_created_at, $is_send) {
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
            if ($is_send) {
                MailSend::create([
                    'mail_id' => $mail->mail_id,
                ]);
            }
            $recive_user = ReceiveUser::updateOrCreate([
                'email' => $from_email,
            ], [
                'name' => $name,
            ]);
            MailProfile::create([
                'mail_id' => $mail->mail_id,
                'receive_user_id' => $recive_user->receive_user_id,
                'mail_text_url' => $mail_text_url,
                'mail_created_at' => new Carbon($mail_created_at),
            ]);
        });
    }

    public function mail_delete(string $mail_id)
    {
        DB::transaction(function () use ($mail_id) {
            Mail::where('user_id', auth()->id())
                ->findOrFail($mail_id);
            MailActive::destroy($mail_id);
            MailDelete::updateOrCreate([
                'mail_id' => $mail_id
            ], []);
        });
    }
}
