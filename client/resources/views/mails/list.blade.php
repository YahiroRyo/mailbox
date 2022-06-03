@extends('layouts.common')

@section('title', 'メール受信ボックス')

@section('main')
<ul>
    @foreach ($mails as $mail)
        <li>
            <a href="/users/mails/mail?mail_id={{ $mail['mail_id'] }}" class="flex align-center gap-10 p-5 border-gray-200 border-2 bg-white hover:bg-gray-200 {{ $mail['readed'] ? 'bg-gray-200' : '' }}">
                <span class="font-bold text-gray-700">{{$mail['content']['created_at']}}</span>
                <p class="font-bold text-gray-700">{{$mail['content']['subject']}}</p>
            </a>
        </li>
    @endforeach
</ul>
@endsection
