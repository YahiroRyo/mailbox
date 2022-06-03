@extends('layouts.common')

@section('title', $mail['content']['subject'])

@section('main')
    <div class="w-3/4 mt-10 mx-auto">
        <a class="text-gray-900" href="{{url()->previous()}}">← 戻る</a>
        <h2 class="text-gray-700 font-bold text-2xl mt-5">件名</h2>
        <p class="text-gray-700 text-xl mt-1">{{$mail['content']['subject']}}</p>
        <div class="flex items-center gap-2 mt-1">
            <img class="w-5" src="/images/clock.png" alt="時間">
            <span class="text-gray-900 text-base">{{$mail['content']['created_at']}}</span>
        </div>
        <h2 class="text-gray-700 font-bold text-2xl mt-4">本文</h2>
        <p class="mt-1 text-lg whitespace-pre-wrap">{!! $mail['content']['body'] !!}</p>
    </div>
@endsection
