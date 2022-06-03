<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailFindOneRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mail_id' => ['required', 'exists:mails'],
        ];
    }
}
