<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\MailFindOneRequest;
use App\Services\MailService;
use Illuminate\Http\Request;

class MailReceiveController extends Controller
{
    private $mail_service;
    public function __construct()
    {
        $this->mail_service = new MailService();
    }

    public function find_all()
    {
        return view('mails.received_list', [
            'mails' => $this->mail_service->recive_find_all()
        ]);
    }

    public function find_one(MailFindOneRequest $request)
    {
        return view('mails.mail', [
            'mail' => $this->mail_service->recive_find_one($request->mail_id)
        ]);
    }

    public function mail_delete(Request $request, string $mail_id)
    {
        $this->mail_service->mail_delete($mail_id);
        return redirect('/users/receive/mails');
    }
}
