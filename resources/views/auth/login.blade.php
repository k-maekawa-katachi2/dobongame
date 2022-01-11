{{-- @extends('layouts.fighter')

@section('content') --}}

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン</title>
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
            padding: 1rem 10px 30px 5rem;
            /* 半径が8pxの角丸 */
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="row">
                    <div class="card mt-5">
                        <div class="card-header">
                            <h4 style="text-align: center">---　ログインをしてゲームを始めよう　---</h4>
                            <p>ご登録していただいているメールアドレスとパスワードを入力し
                                最後にチェックボックスのチェックを入れて「ログイン」を押してください。</p>
                            <p> また、初めての方は、「新規登録をする」のボタンをクリックして、必要事項を記入してください
                                ※　ログインが完了しましたら、再度トップページに戻ります</p>


                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row mt-3">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('●　メールアドレス') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-5">
                                    <label for="password"
                                        class="col-md-4 col-form-label text-md-right">{{ __('●　パスワード') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('こちらにチェックを入れてください') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mt-3 mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('ログイン') }}
                                        </button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}"
                                                style="padding-left:30px;">
                                                {{ __('パスワードを忘れた方はこちら') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </form>
                            <div class="row mt-5">
                                <div class="box mt-3" style="background: rgb(222, 233, 238);">
                                    <form action="{{ route('register') }}" method="get">
                                        <h4 style="text-align: center">---【新規登録】---</h4>
                                        <p>初めての方は下の「新規登録」をクリックしてください</p>
                                        <p><input type="submit" value="新規登録をする" class="btn btn-danger"></p>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mr-3">

                <div class="row">
                    <img class="img-fluid" src="{{ asset('images/fighter.png') }}" style="height:50%;">
                </div>
            </div>
        </div>

    </div>
</body>

</html>

{{-- @endsection --}}
