@extends('layouts.common')

@section('title', 'ユーザー作成')

@section('main')
<div class="flex h-screen w-full items-center justify-center bg-sky-50">
    <form class="bg-white shadow-md rounded p-8 w-5/6 sm:w-3/4 md:w-1/2" action="/users/create" method="POST">
        @csrf
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">メールアドレス</label>
            <div class="flex items-center gap-3">
                <input
                    name="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{
                        $errors->has('email') ? 'border-red-500' : ''
                    }}"
                    id="email" type="text"
                    placeholder="example"
                    required
                >
                <span class="text-gray-500 font-bold text-sm">@mail.yappi.jp</span>
            </div>
            @if ($errors->has('email'))
                <p class="text-red-500 text-xs italic m-1">{{$errors->first('email')}}</p>
            @endif
        </div>
        <div class="mb-5">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">パスワード</label>
            <input
                name="password"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{
                    $errors->has('password') ? 'border-red-500' : ''
                }}"
                id="password"
                type="password"
                placeholder="*******"
                required
            >
            @if ($errors->has('password'))
                <p class="text-red-500 text-xs italic m-1">{{$errors->first('password')}}</p>
            @endif
        </div>
        <div class="flex items-center justify-center">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                アカウント作成
            </button>
        </div>
        <p class="mt-5 text-center text-gray-500 text-xs">
          &copy;2022 yappi. All rights reserved.
        </p>
    </form>
</div>
@endsection
