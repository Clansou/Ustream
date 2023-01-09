<?php
    $api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
    $json_data = file_get_contents($api_url);
    $film = json_decode($json_data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.png">
    <title><?= $film->title ?> - Ustream</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>
<body>
<?php
session_start();
?>
<header class="flex flex-col items-center px-4 py-[10vh] bg-white shadow-2xl">
    <div class="flex items-center justify-between w-full">
        <a class="sm:w-[350px] w-[300px] ml-8" href="http://ustream.test/films/1">
            <img src="/img/logo.png" alt="Logo">
        </a>
        <div class="flex flex-row justify-end gap-4 mr-8">
            <a class="w-[50px]" href="http://ustream.test/my_profil">
                <img class="m-2" src="/img/profil.png" alt="Profil">
            </a>
            <?php if(Auth::check()){ ?>
            <a class="w-[50px]" href="http://ustream.test/signout">
                <img class="m-2" src="/img/logout.png" alt="Logout">
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="flex flex-col items-center mt-[3%] gap-8 md:flex-row">
        <?php require(app_path("require_resources\search.php")) ;?>
        <div class="flex gap-8">
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
    </div>
</header>
<?php if(isset($_GET['Search'])){
    display_search();
}?>


<h3 class="filmTitle font-bold">{$id_film->title}</h3>
<?php
  $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
  $filmNoImg = "/img/noimg.jpg";
  $posterExists = $film->poster_path;
  $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
?>

<div class="flex flex-col p-8 bg-[#f5e5ae]">
    <div class="flex flex-col md:flex-row items-center">
        <img class="md:w-[25vw] w-[50vw]" src="<?= $filmImg ?>" alt="Film Poster">
        <div class="flex flex-col p-8 justify-between">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <h3 class="font-bold text-3xl text-grey border-t-8 border-l-8 border-grey p-8">{{ $film->title }}</h3>
                    <div class="flex justify-between mt-2 w-[20vw] flex-col md:flex-row">
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
                    {{--{!!Form::open(['url' => ['add_film_in_album',$film->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'INSERT')}}
                    {{Form::submit('Add', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}--}}
                    <button class="addMovieBtn" type="button">
                        <img class="w-[70px] m-2" src="/img/addmovie.png" alt="Add Movie To Playslist">
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="actors">
        <?php
        $api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'/credits?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
        $json_data = file_get_contents($api_url);
        $film = json_decode($json_data);
        ?>
        <h2 class="text-2xl font-bold mx-[4%] mt-[3%]">Actors</h2>
        <div class="carousel-container select-none">
            <div class="inner-carousel">
                <div class="carousel-track">
                    @foreach($film->cast as $character)
                            <?php if($character->known_for_department == "Acting" && $character->profile_path != "" ){?>
                        <div class="card md:w-[7vw!important] mx-4">
                            <h3 class="filmTitle font-bold"> {{$character->name}}</h3>
                            <img src="https://image.tmdb.org/t/p/w220_and_h330_face/{{$character->profile_path}}" alt="Actor Image">
                        </div>
                        <?php }?>
                    @endforeach
                </div>
            </div>
            <div class="nav">
                <button class="prev"><img class="" src="/img/larrow.svg" alt="Profil"></button>
                <button class="next"><img class="" src="/img/rarrow.svg" alt="Profil"></button>
            </div>
        </div>
    </div>
</div>

<?php
$api_url = 'https://api.themoviedb.org/3/movie/'.$id_film.'/similar?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
$json_data = file_get_contents($api_url);
$film = json_decode($json_data);
//print_r($film);
?>
<h2 class="text-2xl font-bold mx-[4%] mt-[3%]">Similar Movies</h2>
<div class="carousel-container2 select-none">
    <div class="inner-carousel">
        <div class="carousel-track2">
            @foreach($film->results as $similar_movie)
                <div class="card mx-4">
                    <a href="http://ustream.test/film/{{$similar_movie->id}}">
                        <h3 class="filmTitle font-bold">{{$similar_movie->title}} </h3>
                            <?php $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$similar_movie->poster_path}";
                            $filmNoImg = "/img/noimg.jpg";
                            $posterExists = $similar_movie->poster_path;
                            $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
                            ?>
                        <img src="<?= $filmImg ?>" alt="Film Poster">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="nav">
        <button class="prev2"><img class="" src="/img/larrow.svg" alt="Left Arrow"></button>
        <button class="next2"><img class="" src="/img/rarrow.svg" alt="Right Arrow"></button>
    </div>
</div>

<footer class="bg-grey text-yellow flex flex-col md:flex-row items-center gap-[10%] p-[5%]">
    <img class="w-[200px]" src="/img/logowhite.png" alt="Logo">
    <div class="md:w-[50vw] w-[80vw]">
        <h2 class="text-2xl font-semibold my-2">Genres</h2>
        <div class="mx-2 grid grid-cols-4 w-[100%] gap-[5%]">
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
</footer>

</body>
<script type="text/javascript" src="/main.js"></script>
</html>
