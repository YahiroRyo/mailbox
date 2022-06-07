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
                    <a class="text-gray-700 hover:text-gray-900 h-full flex items-center justify-center text-sm sm:text-base" href="/users/login">ログイン</a>
                </li>
                <li class="h-full">
                    <a class="text-gray-700 hover:text-gray-900 h-full flex items-center justify-center text-sm sm:text-base" href="/users/create">アカウント作成</a>
                </li>
            @else
                <li class="h-full">
                    <a class="text-gray-700 hover:text-gray-900 h-full flex items-center justify-center text-sm sm:text-base" href="/users/logout">ログアウト</a>
                </li>
            @endif
        </ul>
    </header>
    <main class="flex gap-5 justify-between pt-20 relative">
        @if (auth()->check())
            <aside class="w-1/5 sticky top-20 left-0 h-screen">
                <nav>
                    <ul>
                        <li>
                            <a class="block border-b-gray-200  border-b-2 p-5 hover:text-blue-700 {{ request()->path() == 'users/mails' ? 'text-blue-700' : 'text-gray-700'}}"  href="/users/mails">受信メール一覧</a>
                        </li>
                        <li>
                            <a class="block border-b-gray-200  border-b-2 p-5 hover:text-blue-700 {{ request()->path() == 'users/mails/send' ? 'text-blue-700' : 'text-gray-700'}}" href="/users/mails/send">メールを送信</a>
                        </li>
                    </ul>
                </nav>
            </aside>
        @endif
        <div class="{{ auth()->check() ? 'w-4/5' : 'w-full'}}">
            @yield('main')
        </div>
    </main>
</body>
</html>
