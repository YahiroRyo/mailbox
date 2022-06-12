@extends('layouts.common')

@section('title', 'メールを送信')

@section('main')
    <form class="w-4/5 mx-auto my-0 pt-10" action="/users/send" method="POST">
        @csrf
        @if (isset($error_message))
            <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
                <p class="font-bold">ERROR</p>
                <span class="block sm:inline">{!! $error_message !!}</span>
            </div>
        @endif
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="to_addresses">送信先</label>
            <input placeholder="example@gamil.com" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{
                $errors->has('to_addresses') ? 'border-red-500' : ''
            }}" id="to_addresses" name="to_addresses" type="text">
            @if ($errors->has('to_addresses'))
                <p class="text-red-500 text-xs italic m-1">{{$errors->first('to_addresses')}}</p>
            @endif
        </div>
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">件名</label>
            <input placeholder="〇〇について" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{
                $errors->has('subject') ? 'border-red-500' : ''
            }}" id="subject" name="subject" type="text">
            @if ($errors->has('subject'))
                <p class="text-red-500 text-xs italic m-1">{{$errors->first('subject')}}</p>
            @endif
        </div>
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="body">本文</label>
            <textarea placeholder="メールの内容" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 h-40 leading-tight focus:outline-none focus:shadow-outline {{
                $errors->has('body') ? 'border-red-500' : ''
            }}" id="body" name="body" type="text"></textarea>
            @if ($errors->has('body'))
                <p class="text-red-500 text-xs italic m-1">{{$errors->first('body')}}</p>
            @endif
        </div>
        <input class="bg-blue-500 hover:bg-blue-700 hover:cursor-pointer text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" value="メッセージを送信">
    </form>
@endsection
