<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .container {
            border: solid;
            border-color: #031de2;
            border-radius: 8px;
            width: 100%;
            height: 40rem;
            margin-top: 5rem
                /* 半径が8pxの角丸 */
        }

        .fadeDown {
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

        .box1 {
            animation-name: fadeRightAnime;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            opacity: 0;
            animation-delay: 0.5s;
        }

        @keyframes fadeRightAnime {
            from {
                opacity: 0;
                transform: translateX(100px);
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
            width: 25%;
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

    </style>
</head>


<body>
    <main>
        <div class="container fadeDown">
            <div class="bgextend bgLRextend"><span class="bgappear">背景色が伸びて出現</span></div>
            <div class="content">
                <div class="row box1">
                    <div class="col-6" style="padding: 10rem 0 0 10rem ">
                        @yield('content')
                    </div>
                    <div class="col-6 mr-3">

                        <div class="row">
                            <img class="img-fluid" src="{{ asset('images/fighter.png') }}" height="30rem">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
