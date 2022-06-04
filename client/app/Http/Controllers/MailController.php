<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailCreateRequest;
use App\Http\Requests\MailFindOneRequest;
use App\Models\Mail;
use App\Models\User;
use App\Services\MailService;

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
        $this->mail_service->mail_create(
            $user->user_id,
            $validated['subject'],
            $validated['body'],
            $validated['cc'],
            $validated['from_email'],
            $validated['mail_text_url'],
            $validated['mail_created_at'],
        );
    }
    public function find_all()
    {
        return view('mails.list', [
            'mails' => Mail::find_all()
        ]);
    }
    public function find_one(MailFindOneRequest $request)
    {
        return view('mails.mail', [
            'mail' => Mail::find_one($request->mail_id)
        ]);
    }
}
