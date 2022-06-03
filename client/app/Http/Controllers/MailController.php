<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailCreateRequest;
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
        $user = User::where('email', $validated['email'])
                    ->has('active')
                    ->firstOrFail();
        $this->mail_service->mail_create(
            $user->user_id,
            $validated['subject'],
            $validated['body']
        );
    }
}
