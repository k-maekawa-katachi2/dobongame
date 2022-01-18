<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>入力言葉の一覧</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">

</head>

<body>

    <div class="container fadeDown">
        <h4>ファイターが入れた言葉です。</h4>
        <div class="row justify-content-start mt-5">
            @foreach ($fighter_word_all as $allWord)
                @if ($allWord->order_count % 4 == 0)
                    <div class="col-3">
                        {{ $allWord->player }}：　{{ $allWord->fighter_word }}
                    </div>
        </div>
        <div class="row justify-content-start">
        @else
            <div class="col-3">
                {{ $allWord->player }}：　{{ $allWord->fighter_word }}
            </div>
            @endif
            @endforeach
        </div>

        <div class="row mt-5">
            <h4>では、勝負の時です。デーモン様の言葉にかかってなければあなたの勝ちです</h4>
            <p>無事、クリアーできたのか？誰かがドボンを当ててしまったのか・・・</p>
            <p>結果を見てみましょう</p>
            <form action="result" method="post">
                @csrf
                <div class="result">
                    <input type="submit" value="結果をみる">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
