<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DOBON_GAME</title>
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<body>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" name="logout">
        @csrf
        {{-- ログアウト中はログアウトするというメッセージを入れない --}}
        @if (Auth::user() !== null)
            <div style="text-align: right;color:white;margin-right:3rem;" ;>
                <p>ようこそ!!　 {{ Auth::user()->name }}　様</p>
                <a href="javascript:document.logout.submit()" style="color:white;">ログアウト</a>
            </div>
        @endif
    </form>

    <form action="players" method="get">
        <input class="button" type="submit" value="ゲームスタート">
    </form>
</body>

</html>
