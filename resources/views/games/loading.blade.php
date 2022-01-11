<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>loading</title>
    <style>
        .container{
            width:100%;
            height: auto;
        }

        video{
            width:100%;
            height:auto;
        }
    </style>
</head>

<body>
    {{-- <video autoplay src="movies/demonplay.mp4"></video> --}}
    <div class="container">
        <video controls autoplay muted="false">
            {{-- <video controls loop autoplay muted width="500px" height="300px"> --}}
            <source src="{{ asset('movies/Loading.mp4') }}" type="video/mp4">
        </video>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    setTimeout(function(){
        window.location.href = 'result';
      }, 5*1000);
</script>
</body>

</html>
