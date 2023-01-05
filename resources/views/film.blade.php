<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.png">
    <title>Ustream</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>
<body>
<?php
session_start();
?>
<header class="flex flex-col items-center px-4 py-[10vh] bg-white shadow-2xl">
    <div class="flex items-center justify-around">
        <img class="w-[20%]" src="/img/logo.png" alt="Logo">
        <div class="flex flex-row justify-end">
            <a class="w-10"href="{{ route('/my_profil') }}"><img class="w-[80%] m-2" src="/img/profil.png" alt="Profil"></a>
            <a class="w-10"href="/"><img class="w-[80%] m-2" src="/img/home.png" alt="Home"></a>
        </div>
    </div>
    <div class="flex items-center mt-[3%] gap-[5%]">
        <?php require(app_path("require_resources\search.php")) ;?>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn bg-yellow font-semibold">Genre</button>
            <div id="myDropdown" class="dropdown-content">
                <div class="dropdown-content-genre grid grid-cols-4 w-[100%]">
                    <?php
                    $each_genres = 'https://api.themoviedb.org/3/genre/movie/list?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
                    $each_genres = file_get_contents($each_genres);
                    $each_genres = json_decode($each_genres);
                    $each_genres= $each_genres->genres;
                    foreach ($each_genres as $each_genre) {

                        ?><a href="http://ustream.test/films/<?php print_r(strtolower($each_genre->name))?>/1"><?php print_r($each_genre->name)?></a>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
<?php if(isset($_GET['Search'])){
    display_search();
}?>


<h3 class="filmTitle font-bold">{$id_film->title}</h3>
<?php


  $api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
  $json_data = file_get_contents($api_url);
  $film = json_decode($json_data);
  $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
  $filmNoImg = "/img/noimg.jpg";
  $posterExists = $film->poster_path;
  $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
?>

<div class="flex flex-col p-8 bg-[#f5e5ae]">
    <div class="flex">
        <img class="w-[25vw]" src="<?= $filmImg ?>" alt="Film Poster">
        <div class="flex flex-col p-8 justify-between">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h3 class="font-bold text-3xl text-grey border-t-8 border-l-8 border-grey p-8">{{ $film->title }}</h3>
                    <div class="flex justify-between mt-2 w-[20vw]">
                        <p class=""><strong class=" text-grey">Release date:</strong>  {{ $film->release_date }}</p>
                        <p class="font-bold text-grey">{{ $film->runtime }}min</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <p class="font-bold text-grey text-large">Users' Rank</p>
                    <div class="flex flex-col items-center p-4 rounded-full border-4 border-grey bg-green-600">
                        <p class="font-bold">{{ $film->vote_average }}</p>
                    </div>

                </div>

            </div>
            <p class="">{{ $film->overview }}</p>
            <div class="flex justify-between items-center">
                <div class="flex flex-col">
                    <p class="font-bold text-grey">Genres:</p>
                    <div class="flex gap-4 w-[50vw]">
                        @foreach($film->genres as $each_genre)
                            <p class="flex before:content-['-']">{{ $each_genre->name }}</p>
                        @endforeach
                    </div>
                </div>
                <div class="border-b-8 border-r-8 border-grey p-4">
                    <button class="addMovieBtn" type="button">
                        <img class="w-[20%] m-2" src="/img/addmovie.png" alt="Add Movie To Playslist">
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="nav">
        <button class="prev"><img class="" src="/img/larrow.svg" alt="Profil"></button>
        <button class="next"><img class="" src="/img/rarrow.svg" alt="Profil"></button>
    </div>
</div> 
<?php
$api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'/similar?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
$json_data = file_get_contents($api_url);
$film = json_decode($json_data);
//print_r($film);
?>
<h2>Similar Movie</h2>
<div class="carousel-container select-none">
    <div class="inner-carousel">
        <div class="carousel-track">
@foreach($film->results as $similar_movie)
    <div class="flex mx-4">
        <a href="">
        <h3 class="filmTitle font-bold">{{$similar_movie->title}} </h3>
        <?php $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$similar_movie->poster_path}";
        $filmNoImg = "/img/noimg.jpg";
        $posterExists = $similar_movie->poster_path;
        $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
        ?>
        <img src="<?= $filmImg ?>" alt="Film Poster">
    </div>

@endforeach
        </div>
    </div>
    <div class="nav">
        <button class="prev"><img class="" src="/img/larrow.svg" alt="Profil"></button>
        <button class="next"><img class="" src="/img/rarrow.svg" alt="Profil"></button>
    </div>
</div>

</body>
<script type="text/javascript" src="/main.js"></script>
</html>
