<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mail\MailSendRequest;
use App\Http\Requests\Mail\MailFindOneRequest;
use App\Models\Mail\Domain\Mail as DomainMail;
use App\Services\MailService;
use Aws\Ses\Exception\SesException;
use Aws\Ses\SesClient;
use Carbon\Carbon;

class MailSendController extends Controller
{
    private $mail_service;
    public function __construct()
    {
        $this->mail_service = new MailService();
    }

    public function view()
    {
        return view('mails.send');
    }

    public function mail_send(MailSendRequest $request)
    {
        $validated = $request->validated();
        $email = auth()->user()->email;
        $charset = 'UTF-8';

        try {
            $client = new SesClient([
                'region' => 'us-east-1',
                'version' => '2010-12-01',
            ]);
            $client->sendEmail([
                'Destination' => [
                    'ToAddresses' => [$validated['to_addresses']],
                ],
                'ReplyToAddresses' => [$email],
                'Source' => $email,
                'Message' => [
                    'Body' => [
                        'Text' => [
                            'Charset' => $charset,
                            'Data' => $validated['body'],
                        ],
                    ],
                    'Subject' => [
                        'Charset' => $charset,
                        'Data' => $validated['subject'],
                    ]
                ]
            ]);

            $domain_mail = new DomainMail(
                auth()->id(),
                $validated['subject'],
                $validated['body'],
                '',
                $email,
                $email,
                '',
                Carbon::now()->toString(),
            );
            $this->mail_service->send_mail_create($domain_mail);
        } catch (SesException $e) {
            logs()->error($e->getMessage());
			logs()->error('REQUEST', $request->toArray());
            return view('mails.send', [
                'error_message' => '不明なエラーが発生しました。<br/>フォームの内容をもう一度確認の上送信ください。'
            ]);
        }
        return redirect('/users/send');
    }

    public function find_all()
    {
        return view('mails.sended_list', [
            'mails' => $this->mail_service->send_find_all()
        ]);
    }

    public function find_one(MailFindOneRequest $request)
    {
        return view('mails.mail', [
            'mail' => $this->mail_service->send_find_one($request->mail_id)
        ]);
    }
}
