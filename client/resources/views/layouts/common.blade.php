<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>@yield('title') | メールボックス</title>
</head>
<body>
    <header class="fixed flex items-center justify-between gap-5 w-full bg-white border-b p-5 drop-shadow-md z-10 h-20">
        <ul>
            <li>
                <a href="/">
                    <img class="h-20" src="{{ asset('images/yappi.jpg') }}" alt="ヤッピー">
                </a>
            </li>
        </ul>
        <ul class="flex items-center justify-center gap-5 h-full">
            @if (!auth()->check())
                <li class="h-full">
                    <a class="text-gray-700 hover:text-gray-900 h-full flex items-center justify-center" href="/users/login">ログイン</a>
                </li>
                <li class="h-full">
                    <a class="text-gray-700 hover:text-gray-900 h-full flex items-center justify-center" href="/users/create">アカウント作成</a>
                </li>
            @else
                <li class="h-full">
                    <a class="text-gray-700 hover:text-gray-900 h-full flex items-center justify-center" href="/users/logout">ログアウト</a>
                </li>
            @endif
        </ul>
    </header>
    <main class="pt-20">
        @yield('main')
    </main>
</body>
</html>
