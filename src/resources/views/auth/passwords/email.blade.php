<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>パスワードを再登録</title>
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
                            <h4 style="text-align: center">---　パスワードを再登録する　---</h4>
                            <p>新しくパスワードを作成します。
                                ご登録していただいているメールアドレス入力し「送信する」を押してください。</p>
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-4 col-form-label text-md-right">{{ __('メールアドレスを入力してください') }}</label>

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

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('送信する') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 mr-3">

                <div class="row">
                    <img class="img-fluid" src="{{ asset('images/demon.png') }}" style="height:50%;">
                </div>
            </div>
        </div>

    </div>
</body>

</html>