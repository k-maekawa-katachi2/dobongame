<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ドボーンしりとり</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        .container {
            border: solid;
            border-color: #031de2;
            border-radius: 8px;
            width: 100%;
            /* height: 40rem; */
            margin-top: 5rem;
            /* 半径が8pxの角丸 */
            padding: 5rem 0 0 10rem;
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

        .container.fadeup {
            opacity: 0;
        }

        .container.fadeUp {
            animation-name: fadeUpAnime;
            animation-duration: 2.0s;
            animation-fill-mode: forwards;
            opacity: 1;

        }

        @keyframes fadeUpAnime {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-150px);
            }
        }

        .box1 {
            animation-name: fadeRightAnime1;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            opacity: 0;
            animation-delay: 0.5s;
        }

        .box2 {
            animation-name: fadeRightAnime2;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            opacity: 0;
            animation-delay: 1.0s;
        }

        .box3 {
            animation-name: fadeRightAnime3;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            opacity: 0;
            animation-delay: 1.5s;
        }

        @keyframes fadeRightAnime1 {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeRightAnime2 {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeRightAnime3 {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .bgextend {
            animation-name: bgextendAnimeBase;
            animation-duration: 1s;
            animation-fill-mode: forwards;
            animation-delay: 3s;
            position: relative;
            overflow: hidden;
            /*　はみ出た色要素を隠す　*/
            opacity: 0;

        }

        @keyframes bgextendAnimeBase {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /*中の要素*/
        .bgappear {
            animation-name: bgextendAnimeSecond;
            animation-duration: 1s;
            animation-delay: 3.6s;
            animation-fill-mode: forwards;
            opacity: 0;
        }

        @keyframes bgextendAnimeSecond {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /*--------- 左から --------*/
        .bgLRextend::before {
            animation-name: bgLRextendAnime;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            content: "";
            position: absolute;
            width: 50%;
            height: 100%;
            background-color: rgb(208, 241, 15);
            /*伸びる背景色の設定*/
            animation-delay: 3s;
        }

        @keyframes bgLRextendAnime {
            0% {
                transform-origin: left;
                transform: scaleX(0);
            }

            50% {
                transform-origin: left;
                transform: scaleX(1);
            }

            50.001% {
                transform-origin: right;
            }

            100% {
                transform-origin: right;
                transform: scaleX(1);
            }
        }

        */

    </style>


</head>

<body>

    <div class="container fadeDown">
        <div class="row">
            <div class="col-6">

                @isset($first_player)
                    <form action="fighters" method="post" id="form">
                        @csrf
                        <div class="bgextend bgLRextend">
                            <h3 class="bgappear">ファイター:
                                {{ $first_player->player }}さん　</h3>
                        </div>
                        <h4 class="box2" style="margin-top: 3rem">最初の言葉を入れてください！！</h4>
                        <p class="box2">言葉はひらがなで入力してください。</p>
                  
            
                        <div class="box3">
                            <p><input type="text" name="fighter_word" value="{{ old('fighter_word') }}"></p>
                            <input type="hidden" name="player_id" value="{{ $first_player->id }}">
                            <input type="hidden" name="order_count" value="{{ $first_player->player_number }}">
                            <input type="hidden" name="turn" value="{{ $turn }}">
                            <input type="submit" value="次へ">
                        </div>
                    </form>
                @endisset
                {{-- {{$turn}} --}}


                @isset($next_fighter)
                    <form action="fighters" method="post" id=form>
                        @csrf
                        <div class="bgextend bgLRextend">
                            <h3 class="bgappear">ファイター
                                {{ $next_fighter->player }}さん　</h3>
                        </div>
                        {{-- <h4 class="box2" style="margin-top: 3rem">   {{ $before_word->fighter_word }}に続く言葉を入れてください！！</h4> --}}

                        <h4 class="box2" style="margin-top: 3rem">
                            {{ $before_word->fighter_word }}に続く言葉を入れてください！！</h4>
                        <p class="box2">言葉はひらがなで入力してください。</p>
                        <p class="box2" style="color:blue;">＊　小文字で終わっている場合は、その文字を大文字にしてしりとりを続けてください<br>
                        （かいしゃ　→　「ゃ」ではなく「や」で始める）</p>
                        {{-- @isset( $msg)
                        {{ $msg}}
                    @endisset --}}
                        <div class="box3 mt-5">
                            <p>{{ $before_word->fighter_word }} ー＞<input type="text" name="fighter_word"
                                    value="{{ old('fighter_word') }}"></p>
                            <input type="hidden" name="player_id" value="{{ $next_fighter->id }}">
                            <input type="hidden" name="order_count" value="{{ $next_fighter->player_number }}">
                            <input type="hidden" name="turn" value="{{ $turn }}">
                            <input type="submit" value="次へ">
                        </div>
                    </form>


                    <div class="row mt-5">
                        <ol>
                            @foreach ($fighter_word_all as $word_all)
                                <li>{{ $word_all->fighter_word }}</li>
                            @endforeach
                        </ol>
                        {{-- {{$turn}} --}}
                    </div>
                @endisset
            </div>


            <div class="col-6">
                <img class="img-fluid" src="{{ asset('images/fighter.png') }}">
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>
