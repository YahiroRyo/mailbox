@extends('layouts.common')

@section('title', 'メール受信ボックス')

@section('main')
<ul class="overflow-y-auto">
    @foreach ($mails as $mail)
        <li class="block align-center justify-between sm:gap-5 sm:flex">
            <a
                href="/users/mails/mail?mail_id={{ $mail['mail_id'] }}"
                class="block align-center w-full px-2 py-5 border-gray-300 border-y-2 bg-white hover:bg-gray-200 sm:p-5 sm:gap-10 sm:flex {{ $mail['readed'] ? 'bg-gray-200 hover:bg-gray-300' : '' }}"
            >
                <span class="text-gray-700">{{$mail['profile']['mail_created_at']}}</span>
                <p class="font-bold text-gray-700 mt-1 sm:mt-0">{{$mail['profile']['receive_user']['email']}}</p>
                <p class="font-bold text-gray-700 mt-3 sm:mt-0">{{$mail['content']['subject']}}</p>
            </a>
            <form action="/users/mails/{{$mail['mail_id']}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">メールを削除</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
