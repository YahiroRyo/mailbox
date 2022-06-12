<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\MailCreateRequest;
use App\Models\Mail\Domain\Mail as DomainMail;
use App\Models\User\Eloquent\User;
use App\Services\MailService;
use Illuminate\Http\Request;

class MailController extends Controller
{
    private $mail_service;
    public function __construct()
    {
        $this->mail_service = new MailService();
    }

    public function mail_create(MailCreateRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['to_email'])
                    ->has('active')
                    ->firstOrFail();
        $domain_mail = new DomainMail(
            $user->user_id,
            $validated['subject'],
            $validated['body'],
            $validated['cc'],
            $validated['name'],
            $validated['from_email'],
            $validated['mail_text_url'],
            $validated['mail_created_at'],
        );
        $this->mail_service->receive_mail_create($domain_mail);
    }
}
