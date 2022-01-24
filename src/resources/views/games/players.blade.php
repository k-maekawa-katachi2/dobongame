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
                    <h4 style="margin-bottom:3rem;">デーモンの種類を決めてください</h4>
                    {{-- バリデーションチェック --}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <strong style="color:red;">{{ $error }}</strong>
                        @endforeach
                    @endif
                    {{-- ここまで --}}

                    {{-- エラー表示 --}}
                    <p><strong id="err_name" style="color:red;"></strong></p>
                    {{-- ここまで --}}

                    <p><input type="radio" name="chara" id="chara" value="1" onchange="myfunc(this.value)"
                            title="プレーヤがデーモンになって悪魔の言葉を作成します">プレーヤ</p>

                    {{-- ここから　プレーヤー時にここに名前表示が現れる --}}
                    <div id="hidden_chara">
                        <p>デーモン様のお名前を入力してください</p>
                        <input type="text" id="player_name" name="player">
                        <input type="hidden" name="player_number" value="0">
                    </div>
                    {{-- ここまで --}}
                    <div class="row mt-3">
                        <p><input type="radio" name="chara" value="0" title="プレーヤがデーモンになって悪魔の言葉を作成します">コンピューター</p>
                    </div>

                    <h4 style="margin-top: 3rem;">このゲームのターン数を入力してください。</h4>
                    <p>ターンの数だけファイターの一人が解答する数が決まります</p>
                    <select name="turn">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <div class="row mt-5">
                        <input type="submit" value="次へ" style="width:100px;" onclick="return check()">
                    </div>
                </form>
            </div>

            <div class="col-6">
                <div class="row">
                    <img class="img-fluid" src="{{ asset('images/demon.png') }}" style="width;50%; height:75%;">
                </div>
            </div>
        </div>
        <script src="{{ asset('/js/game.js') }}"></script>
</body>

</html>
