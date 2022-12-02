<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


    
    
    
@foreach($films_data->results as $films)
    <h1> titre : {{ $films->title }} </h1>
@endforeach
{{$films_data->total_pages}}

<?php if($page != 1){
    ?><a href="http://ustream.test/films/{{$page-1}}">Previous<?php
    }

if($films_data->total_pages >500){
    $max_page = 500;
}
else{
    $max_page = $films_data->total_pages;
}
    
    
    if($page != $max_page){
    ?><a href="http://ustream.test/films/{{$page-1}}">next<?php
    }

?>
    
    
    
</body>
</html>