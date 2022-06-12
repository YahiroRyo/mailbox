<?php

namespace App\Services;

use App\Models\Mail\Domain\Mail as DomainMail;
use App\Models\Mail\Eloquent\Mail;
use App\Models\Mail\Eloquent\MailActive;
use App\Models\Mail\Eloquent\MailContent;
use App\Models\Mail\Eloquent\MailDelete;
use App\Models\Mail\Eloquent\MailProfile;
use App\Models\Mail\Eloquent\MailReaded;
use App\Models\Mail\Eloquent\MailSend;
use App\Models\ReceiveUser\Eloquent\ReceiveUser;
use Illuminate\Support\Facades\DB;

class MailService
{
    public function find_all()
    {
        return Mail::where('user_id', auth()->id())
            ->orderBy('mail_id', 'desc')
            ->doesntHave('send')
            ->has('active')
            ->get();
    }
    public function find_one(string $mail_id)
    {
        return DB::transaction(function () use ($mail_id) {
            $mail = Mail::where('user_id', auth()->id())
                        ->has('active')
                        ->find($mail_id);
            MailReaded::updateOrCreate([
                'mail_id' => $mail_id
            ]);
            return $mail;
        });
    }
    public function receive_mail_create(DomainMail $domain_mail)
    {
        DB::transaction(function() use ($domain_mail) {
            $mail = Mail::create($domain_mail->get_mail());
            $domain_mail->set_eloquent_mail($mail);
            MailContent::create($domain_mail->get_mail_content());
            MailActive::create($domain_mail->get_mail_active());
            $recive_user = ReceiveUser::updateOrCreate($domain_mail->get_email(), $domain_mail->get_name());
            $domain_mail->set_eloquent_receive_user($recive_user);
            MailProfile::create($domain_mail->get_mail_profile());
        });
    }
    public function send_mail_create(DomainMail $domain_mail)
    {
        DB::transaction(function() use ($domain_mail) {
            $mail = Mail::create($domain_mail->get_mail());
            $domain_mail->set_eloquent_mail($mail);
            MailContent::create($domain_mail->get_mail_content());
            MailActive::create($domain_mail->get_mail_active());
            MailSend::create($domain_mail->get_mail_send());
            $recive_user = ReceiveUser::updateOrCreate($domain_mail->get_email(), $domain_mail->get_name());
            $domain_mail->set_eloquent_receive_user($recive_user);
            MailProfile::create($domain_mail->get_mail_profile());
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
