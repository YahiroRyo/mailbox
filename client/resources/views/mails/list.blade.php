@extends('layouts.common')

@section('title', 'メール受信ボックス')

@section('main')
<ul>
    @foreach ($mails as $mail)
        <li>
            <a
                href="/users/mails/mail?mail_id={{ $mail['mail_id'] }}"
                class="block align-center px-2 py-5 border-gray-300 border-y-2 bg-white hover:bg-gray-200 sm:p-5 sm:gap-10 sm:flex {{ $mail['read'] ? 'bg-gray-200 hover:bg-gray-300' : '' }}"
            >
                <span class="font-bold text-gray-700">{{\Carbon\Carbon::parse($mail['content']['created_at'])->format('Y年m月d日H時m分')}}</span>
                <p class="font-bold text-gray-700 mt-1 sm:mt-0">{{$mail['content']['subject']}}</p>
            </a>
        </li>
    @endforeach
</ul>
@endsection
