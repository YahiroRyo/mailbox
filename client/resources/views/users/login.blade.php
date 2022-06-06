@extends('layouts.common')

@section('title', 'ログイン')

@section('main')
<div class="flex h-screen w-full items-center justify-center bg-sky-50">
    <form class="bg-white shadow-md rounded p-8 w-5/6 sm:w-3/4 md:w-1/2" action="/users/login" method="POST">
        @csrf
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">メールアドレス</label>
            <input name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="text" placeholder="example@yappi.jp" required>
        </div>
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">パスワード</label>
            <input name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="*******" required>
        </div>

        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                ログイン
            </button>
        </div>
        <p class="mt-5 text-center text-gray-500 text-xs">
          &copy;2022 yappi. All rights reserved.
        </p>
    </form>
</div>
@endsection
o
