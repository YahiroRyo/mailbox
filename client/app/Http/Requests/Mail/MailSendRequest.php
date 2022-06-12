<?php

namespace App\Http\Requests\Mail;

use Illuminate\Foundation\Http\FormRequest;

class MailSendRequest extends FormRequest
{
    public function attributes()
    {
        return [
            'to_addresses' => '送信先',
            'subject' => '件名',
            'body' => 'メッセージ'
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'to_addresses' => ['required', 'email'],
            'subject' => ['max:256'],
            'body' => ['max:384000'],
        ];
    }
}
