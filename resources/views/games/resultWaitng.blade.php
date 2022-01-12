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
    {{-- <style>
        .container {
            border: solid;
            border-color: #031de2;
            border-radius: 8px;
            width: 100%;
            /* height: 40rem; */
            margin-top: 3rem;
            /* 半径が8pxの角丸 */
            padding: 5rem 0 5rem 10rem;
            /* opacity: 0; */
        }


        .container.fadeDown {
            animation-name: fadeDownAnime;
            animation-duration: 2.0s;
            animation-fill-mode: forwards;
            opacity: 0;

        }

        @keyframes fadeDownAnime {
            from {
                opacity: 0;
                transform: translateY(-150px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style> --}}
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
