<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
   @if ($order_count == 4)       
   <source src="{{ asset('movies/demon2.mp4') }}" type="video/mp4">
   @else
   <source src="{{ asset('movies/demon1.mp4') }}" type="video/mp4">
   @endif
               
        </video>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    setTimeout(function(){
        window.location.href = 'fighters';
      }, 13.5*1000);
</script>
</body>

</html>
