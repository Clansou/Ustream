<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/app.css">
</head>
<body>





@foreach($film_data as $film)
    <div class="filmCard">
        <h2> titre : {{ $film->title }} </h2>
        <p> {{ $film->overview }} </p>
    </div>

@endforeach



</body>
</html>
