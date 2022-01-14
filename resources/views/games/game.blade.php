<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ドボーンしりとり</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/game.css') }}">
</head>

<body>

    <div class="container fadeDown">
        <div class="row">
            <div class="col-6">
                @isset($first_player)
                    <form action="fighters" method="post" name="word_form1">
                        @csrf
                        <div class="bgextend bgLRextend">
                            <h3 class="bgappear">ファイター:
                                {{ $first_player->player }}さん　</h3>
                        </div>
                        <h4 class="box2" style="margin-top: 3rem">最初の言葉を入れてください！！</h4>
                        <p class="box2">言葉はひらがなで入力してください。</p>
                        <p class="box2" style="color:blue;">＊　伸ばす棒「ー」で終わる場合、最後の言葉は棒の一つ手前の文字で判定します。<br>
                            （メーカー　→　この場合「か」で始める）</p>
                            <div id="err_word1" style=color:red;>
                                {{-- 入力エラー時には、ここにエラーメッセージが表示 --}}
                            </div>
                        <div class="box3">
                            <p><input type="text" id="fighter_word1" name="fighter_word"></p>
                            <input type="hidden" name="player_id" value="{{ $first_player->id }}">
                            <input type="hidden" name="order_count" value="{{ $first_player->player_number }}">
                            <input type="hidden" name="turn_count" value="{{ $turn_count }}">
                            <input type="submit" value="次へ" onclick="return word1()">
                        </div>
                    </form>
                @endisset


                @isset($next_fighter)
                    <form action="fighters" method="post" name="word_form2">
                        @csrf
                        <div class="bgextend bgLRextend">
                            <h3 class="bgappear">ファイター
                                {{ $next_fighter->player }}さん　</h3>
                        </div>

                        <h4 class="box2" style="margin-top: 3rem">
                            {{ $last_word }}に続く言葉を入れてください！！</h4>
                        <p class="box2">言葉はひらがなで入力してください。</p>
                        <p class="box2" style="color:blue;">＊　伸ばす棒「ー」で終わる場合、最後の言葉は棒の一つ手前の文字で判定します。<br>
                            （メーカー　→　この場合「か」で始める）</p>

                        <div id="err_word2" style=color:red;>
                            {{-- 入力エラー時には、ここにエラーメッセージが表示 --}}
                        </div>

                        <div class="box3 mt-5">
                            <p>{{ $before_word->fighter_word }} ー＞<input type="text" id="fighter_word2"
                                    name="fighter_word"></p>
                            <input type="hidden" name="player_id" value="{{ $next_fighter->id }}">
                            <input type="hidden" name="order_count" value="{{ $next_fighter->player_number }}">
                            <input type="hidden" name="turn_count" value="{{ $turn_count }}">
                            <input type="text" name="last_word" id="last_word" value="{{ $last_word }}">

                            <input type="submit" value="次へ" onclick="return word2()">
                        </div>
                    </form>


                    <div class="row mt-5">
                        <ol>
                            @foreach ($fighter_word_all as $word_all)
                                <li>{{ $word_all->fighter_word }}</li>
                            @endforeach
                        </ol>
                    </div>
                @endisset
            </div>


            <div class="col-6">
                <img class="img-fluid" src="{{ asset('images/fighter.png') }}">
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/game.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>
