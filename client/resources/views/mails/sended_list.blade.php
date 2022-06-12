@extends('layouts.common')

@section('title', 'メール送信済ボックス')

@section('main')
<ul class="overflow-y-auto">
    @foreach ($mails as $mail)
        <li class="block align-center justify-between sm:gap-5 sm:flex">
            <a
                href="/users/send/mails/mail?mail_id={{ $mail['mail_id'] }}"
                class="block align-center w-full px-2 py-5 border-gray-300 border-y-2 bg-white hover:bg-gray-200 sm:p-5 sm:gap-10 sm:flex {{ $mail['readed'] ? 'bg-gray-200 hover:bg-gray-300' : '' }}"
            >
                <span class="text-gray-700">{{$mail['profile']['mail_created_at']}}</span>
                <p class="font-bold text-gray-700 mt-1 sm:mt-0">{{$mail['profile']['receive_user']['email']}}</p>
                <p class="font-bold text-gray-700 mt-3 sm:mt-0">{{$mail['content']['subject']}}</p>
            </a>
        </li>
    @endforeach
</ul>
@endsection
