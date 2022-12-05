<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustream</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>
<body>

<header class="flex">
    <h2>Bla</h2>
    <h2>Bla</h2>
    <h2>Bla</h2>
</header>

@foreach($films_data->results as $film)
    <div class="filmCard p-4 text-red">
        <h2 class="font-bold"> titre : {{ $film->title }} </h2>
        <p> {{ $film->overview }} </p>
        <img src="https://image.tmdb.org/t/p/original/{{$film->backdrop_path}}" alt="">
    </div>
@endforeach

<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = preg_replace('/0/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/1/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/2/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/3/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/4/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/5/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/6/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/7/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/8/', '', $actual_link ); // remove numbers
$actual_link = preg_replace('/9/', '', $actual_link ); // remove numbers

if($page != 1){
    ?><a href="<?php $actual_link ?>{{$page-1}}">Previous<?php
    }

if($films_data->total_pages >500){
    $max_page = 500;
}
else{
    $max_page = $films_data->total_pages;
}


    if($page != $max_page){
    ?><a href="<?php $actual_link ?>{{$page+1}}">next</a><?php
    }?>





</body>
</html>
