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
            'email' => ['required', 'exists:users'],
            'subject' => ['max:256'],
            'body' => ['max:384000'],
        ];
    }
}
