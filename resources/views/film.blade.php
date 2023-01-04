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
            <img class="w-[4%] m-2" src="/img/profil.png" alt="Profil">
            <img class="w-[4%] m-2" src="/img/logout.png" alt="Logout">
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

<?php

  $api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
  $json_data = file_get_contents($api_url);
  $film = json_decode($json_data);
  $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
  $filmNoImg = "/img/noimg.jpg";
  $posterExists = $film->poster_path;
  $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;

  //$credits = "http://api.themoviedb.org/movie/{$film->id}/credits?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN"
?>

<div class="flex p-8 bg-yellow">
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



<script>
    console.log({{$id_film}});
    console.log("https://api.themoviedb.org/3/movie/{{$id_film}}?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN");
    axios.get("https://api.themoviedb.org/3/movie/{{$id_film}}?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN").then(function (film_data) {
    console.log(film_data.data);
  })

</script>
</body>
</html>
