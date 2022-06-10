<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function validationData()
    {
        $validation_data = parent::validationData();
        $email = $validation_data['email'];
        if (!strpos($email, '<')) return $validation_data;

        $validation_data['email'] = mb_substr(
            $email,
            mb_strpos($email, '<') + 1,
            mb_strpos($email, '>') - mb_strpos($email, '<') - 1
        );
        return $validation_data;
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
