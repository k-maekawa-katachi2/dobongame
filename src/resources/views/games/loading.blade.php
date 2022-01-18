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
    <div class="container">
        <video controls autoplay muted="false">
            <source src="{{ asset('movies/Loading.mp4') }}" type="video/mp4">
        </video>
    </div>

<script>
    setTimeout(function(){
        window.location.href = 'result';
      }, 5*1000);
</script>
</body>

</html>
