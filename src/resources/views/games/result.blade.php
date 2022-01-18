<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>判定結果</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
</head>

<body>
    <div class="container fadeDown">
        <div class="row">
            <div class="col-6">
                @if ($doboon == 'game_over')
                    <h4>デーモンの言葉は</h4>
                    <div class="kana_font">
                        <ul>
                            @foreach ($demon_kana_all as $kana_all)
                                <li>
                                    {{ $kana_all->hiragana }}
                                </li>
                            @endforeach
                    </div>
                    <h4 style="text-align: center;">でした</h4>
                    <div class="row justify-content-start mt-5">
                        <h4 style="text-align: center;">↓　ファイターが入れた言葉です。　↓</h4>
                        @foreach ($fighter_word_all as $allWord)
                            @if ($allWord->order_count % 3 == 0)
                                @if ($allWord->judge == 'doboon')
                                    <div class="col-4 alert alert-danger" role="alert">
                                        {{ $allWord->player }}：<br>
                                        {{ $allWord->fighter_word }}
                                    </div>
                                @else
                                    <div class="col-4">
                                        {{ $allWord->player }}：<br>
                                        {{ $allWord->fighter_word }}
                                    </div>
                                @endif
                    </div>
                    <div class="row justify-content-start mt-3">
                    @else
                        @if ($allWord->judge == 'doboon')
                            <div class="col-4 alert alert-danger" role="alert">
                                {{ $allWord->player }}：<br>
                                {{ $allWord->fighter_word }}
                            </div>
                        @else
                            <div class="col-4">
                                {{ $allWord->player }}：<br>
                                {{ $allWord->fighter_word }}
                            </div>
                        @endif
                @endif
                @endforeach
            </div>
            <p>残念でした</p>

        @else
            <h4>デーモンの言葉は</h4>
            <div class="kana_font">
                <ul>
                    @foreach ($demon_kana_all as $kana_all)
                        <li>
                            {{ $kana_all->hiragana }}
                        </li>
                    @endforeach
            </div>
            <p style="text-align: center;">でした</p>
            <p>おめでとうございます</p>

            <div class="row justify-content-start mt-5">
                <h4 style="text-align: center;">↓　ファイターが入れた言葉です。　↓</h4>
                @foreach ($fighter_word_all as $allWord)
                    @if ($allWord->order_count % 3 == 0)

                        <div class="col-4">
                            {{ $allWord->player }}：　{{ $allWord->fighter_word }}
                        </div>
            </div>
            <div class="row justify-content-start">
            @else
                <div class="col-4">
                    {{ $allWord->player }}：<br>
                    {{ $allWord->fighter_word }}
                </div>
                @endif
                @endforeach
            </div>
            @endif

            <div class="last mt-5">
                <h1 style="text-align: center;">{{ $doboon }}</h1>
            </div>
            <div class="result">
                <form action="{{route('welcome')}}" method="get">
                    <input type="submit" value="もう一度ゲームする">
                </form>
            </div>
        </div>

        <div class="col-6">
            @if ($doboon == 'game_over')
                <img class="img-fluid" src="{{ asset('images/demon.png') }}">
            @else
                <img class="img-fluid" src="{{ asset('images/fighter.png') }}">
            @endif
        </div>
    </div>
</body>

</html>
