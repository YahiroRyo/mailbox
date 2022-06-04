<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mail_text_url' => ['required', 'url'],
            'mail_created_at' => ['required'],
            'name' => ['nullable'],
            'cc' => ['nullable'],
            'from_email' => ['required'],
            'to_email' => ['required', 'exists:users,email'],
            'subject' => ['max:256'],
            'body' => ['max:384000'],
        ];
    }
}
