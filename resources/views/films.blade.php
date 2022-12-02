<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>
<body>

<header class="flex">
    <h2>Bla</h2>
    <h2>Bla</h2>
    <h2>Bla</h2>
</header>



@foreach($film_data as $film)
    <div class="filmCard p-4 text-red">
        <h2 class="font-bold"> titre : {{ $film->title }} </h2>
        <p> {{ $film->overview }} </p>
    </div>

@endforeach



</body>
</html>
