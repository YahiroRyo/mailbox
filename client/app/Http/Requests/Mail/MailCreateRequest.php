<?php

namespace App\Http\Requests\Mail;

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
        $to_email = $validation_data['to_email'];
        if (mb_strpos($to_email, '<') === false) return $validation_data;

        $validation_data['to_email'] = mb_substr(
            $to_email,
            mb_strpos($to_email, '<') + 1,
            mb_strpos($to_email, '>') - mb_strpos($to_email, '<') - 1
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
