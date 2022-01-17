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
                <form action="demmon_words" method="post">
                    @csrf

                    <h4>デーモン：{{($demon_name->player)}}様、ドボーンの言葉（ひらがな１文字）を３つ登録してください</h4>
                    <p>各枠に異なる言葉（ひらがな１文字）を入れてください</p>
                    <p>該当するひらがなの番号を記入してください</p>
                  @isset($msg)
                  <div class="alert alert-danger" role="alert">
                    {{$msg}}
                  </div>
                  @endisset
                
                    <p>１つめ：<input type="password" name="demon_word1" value="{{ old('demon_word1') }}"></p>
                    <p>２つめ：<input type="password" name="demon_word2" value="{{ old('demon_word2') }}"></p>
                    <p>３つめ：<input type="password" name="demon_word3" value="{{ old('demon_word3') }}"></p>

             
                        <input type="submit" value="ゲームスタート">
                </form>
            </div>

            <div class="col-6">
                <div class="row">
                    <div style="text-align: center">
                    <h1>ひらがな一覧表示</h1>
                    <h4>該当するひらがなの番号を記入してください</h4>
                    </div>
                    <div class="row justify-content-center mt-5">

                        @foreach ($kana_alls as $kana_all)

                            @if ($kana_all->word_id % 5 == 0)
                                <div class="col-2">
                                    {{ $kana_all->word_id }} : {{ $kana_all->hiragana }}
                                </div>
                    </div>
                    <div class="row justify-content-center">

                    @else
                        <div class="col-2">
                            {{ $kana_all->word_id }} : {{ $kana_all->hiragana }}
                        </div>
                     
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
