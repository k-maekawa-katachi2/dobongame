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
            height: auto;
            margin-top: 3rem;
            padding: 5rem 10px 30px 5rem;
            /* 半径が8pxの角丸 */
        }


    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="players" method="post">
                    @csrf
                    <h4 style="margin-bottom:3rem;">デーモンの種類を決めてください</h4>
                    <p><input type="radio" name="chara" value="1" title="プレーヤがデーモンになって悪魔の言葉を作成します">プレーヤ</p>
                    <p>デーモン様のお名前を入力してください</p>
                    <input type="text" name="player" value="{{ old('demon') }}">
                    <input type="hidden" name="player_number" value="0">
                    <div class="row mt-3">
                        <p><input type="radio" name="chara" value="0" title="プレーヤがデーモンになって悪魔の言葉を作成します">コンピューター</p>
                        <input type="submit" value="次へ" style="width:100px;">
                    </div>
                </form>
            </div>

            <div class="col-6">
                <div class="row">
                    <img class="img-fluid" src="{{ asset('images/demon.png') }}" style="width;50%; height:75%;">
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</body>

</html>
