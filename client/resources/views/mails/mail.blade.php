@extends('layouts.common')

@section('title', $mail['content']['subject'])

@section('main')
    <div class="w-3/4 mt-10 mx-auto">
        <a class="text-gray-900" href="{{url()->previous()}}">← 戻る</a>
        <div class="flex items-center gap-2 mt-5">
            <img class="w-5" src="{{ asset('/images/clock.png') }}" alt="時間">
            <span class="text-gray-900 text-base">{{\Carbon\Carbon::parse($mail['profile']['receive_user']['mail_created_at'])->format('Y年m月d日H時m分')}}</span>
        </div>
        <h2 class="text-gray-700 font-bold text-2xl mt-5">送信元</h2>
        <p class="text-gray-700 mt-1">{{$mail['profile']['receive_user']['name']}}</p>
        <p class="text-gray-700">{{$mail['profile']['receive_user']['email']}}</p>
        <h2 class="text-gray-700 font-bold text-2xl mt-5">件名</h2>
        <p class="text-gray-700 text-base mt-1 sm:text-xl">{{$mail['content']['subject']}}</p>
        <h2 class="text-gray-700 font-bold text-2xl mt-4">本文</h2>
        <p class="mt-1 text-base whitespace-pre-wrap sm:text-xl">
            <iframe srcdoc="{{ $mail['content']['body'] }}"></iframe>
        </p>
    </div>
@endsection
