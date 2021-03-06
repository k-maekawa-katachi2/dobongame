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
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="players" method="post" name="player_form">
                    @csrf
                    <br>
                    <h4 style="margin-bottom:3rem;">{{ $next }}人目、ファイターの名前を入力してください</h4>
                    <input type="hidden" name="chara" value="2">
                    <input type="hidden" name="player_number" value="{{ $next }}">
                    {{-- エラー表示　ここから --}}
                    <p><strong id="err_name" style="color:red;"></strong></p>
                    {{-- ここまで --}}
                    <input type="text" name="player">
                    <div class="row mt-3">
                        ファイターの人数を追加するときは「追加」ボタンを、全てのエントリー者の入力が終わったら「決定」を押してください
                    </div>
                    <br>
                    <input type="submit" value="追加" onclick="return check()">
                </form>

                <form action="demmon_words" method="get">
                    <br>
                    @isset($chara_id)
                        <input type="submit" value="ゲームスタート">
                    @else
                        <input type="submit" value="決定">
                    @endisset
                </form>

                <div class="row justify-content-start mt-5">
                    @foreach ($players as $menber)
                        @if ($menber->chara == 2)
                            @if ($menber->player_number % 4 == 0)
                                <div class="col-3">
                                    {{ $menber->player_number }}人目：{{ $menber->player }}
                                </div>
                </div>
                <div class="row justify-content-start">
                @else
                    <div class="col-3">
                        {{ $menber->player_number }}人目：{{ $menber->player }}
                    </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-6">
                <img class="img-fluid" src="{{ asset('images/fighter.png') }}">
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/game.js') }}"></script>
</body>

</html>
