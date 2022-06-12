<?php

namespace App\Models\Mail\Domain;

use App\Models\Mail\Eloquent\Mail as EloquentMail;
use App\Models\ReceiveUser\Eloquent\ReceiveUser as EloquentReceiveUser;
use Carbon\Carbon;

class Mail {
    private EloquentMail $eloquent_mail;
    private EloquentReceiveUser $eloquent_receive_user;

    private int $user_id;
    private string $subject;
    private string $body;
    private ?string $cc;
    private string $name;
    private string $from_email;
    private string $mail_text_url;
    private string $mail_created_at;

    public function __construct(
        int $user_id,
        string $subject,
        string $body,
        ?string $cc,
        string $name,
        string $from_email,
        string $mail_text_url,
        string $mail_created_at
    )
    {
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->body = $body;
        $this->cc = $cc;
        $this->name = $name;
        $this->from_email = $from_email;
        $this->mail_text_url = $mail_text_url;
        $this->mail_created_at = $mail_created_at;
    }

    public function set_eloquent_mail(EloquentMail $eloquent_mail): void
    {
        $this->eloquent_mail = $eloquent_mail;
    }
    public function set_eloquent_receive_user(EloquentReceiveUser $eloquent_receive_user): void
    {
        $this->eloquent_receive_user = $eloquent_receive_user;
    }

    public function get_mail(): array
    {
        return [
            'user_id' => $this->user_id
        ];
    }
    public function get_mail_content(): array
    {
        return [
            'mail_id' => $this->eloquent_mail->mail_id,
            'subject' => $this->subject,
            'cc' => $this->cc,
            'body' => $this->body
        ];
    }
    public function get_mail_active(): array
    {
        return [
            'mail_id' => $this->eloquent_mail->mail_id,
        ];
    }
    public function get_mail_send(): array
    {
        return [
            'mail_id' => $this->eloquent_mail->mail_id,
        ];
    }
    public function get_email(): array
    {
        return [
            'email' => $this->from_email
        ];
    }
    public function get_name(): array
    {
        return [
            'name' => $this->name
        ];
    }
    public function get_mail_profile(): array
    {
        return [
            'mail_id' => $this->eloquent_mail->mail_id,
            'receive_user_id' => $this->eloquent_receive_user->receive_user_id,
            'mail_text_url' => $this->mail_text_url,
            'mail_created_at' => new Carbon($this->mail_created_at),
        ];
    }
}
