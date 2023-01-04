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
    if(isset($_GET['Sort_by'])){
            $_SESSION['Sort_by'] = $_GET['Sort_by'];
    }
    if(isset($genre_id)){
        if(isset($_SESSION['Sort_by'])){
            $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by='.$_SESSION['Sort_by'].'&with_genres='.$genre_id.'&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
        }else{
            $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&with_genres='.$genre_id.'&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
        }
    }else{
        if(isset($_SESSION['Sort_by'])){
            $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by='.$_SESSION['Sort_by'].'&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
        }else{
            $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
        }
    }

    $json_data = file_get_contents($api_url);
    $films_data = json_decode($json_data);

?>
<header class="flex flex-col items-center px-4 py-[10vh] bg-white shadow-2xl">
    <div class="flex items-center justify-around">
        <img class="w-[20%]" src="/img/logo.png" alt="Logo">
        <div class="flex flex-row justify-end">
            <img class="w-[4%] m-2" src="/img/profil.png" alt="Profil">
            <img class="w-[4%] m-2" src="/img/home.png" alt="Home">
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
        <form id="header-tri" action="" method="get">
            <div id="select">
                <select class="bg-yellow p-4 font-semibold" name="Sort_by"  onchange='if(this.value != 0) { this.form.submit(); }'>
                    <option class="text-center bg-yellow text-grey font-semibold">-- Sort movies --</option>
                    <option class="bg-[#f1f1f1]" name="c" value="popularity.desc">Popularity: High to Low</option>
                    <option class="bg-[#f1f1f1]" name="bl" value="popularity Asc">Popularity: Low to High</option>
                    <option class="bg-[#f1f1f1]" name="bl" value="original_title.desc">Name: desc</option>
                    <option class="bg-[#f1f1f1]" name="bl" value="original_title.asc">Name: asc</option>
                    <option class="bg-[#f1f1f1]" name="bl" value="top_rated.desc">Top rated: High to Low</option>
                    <option class="bg-[#f1f1f1]" name="bl" value="top_rated.asc">Top rated: Low to High</option>
                </select>
            </div>
        </form>
    </div>
</header>
<?php if(isset($_GET['Search'])){
    display_search();
}?>
<?php //echo $_SESSION['Sort_by'];
//print_r($_SESSION['Sort_by']);
if(isset($_SESSION['Sort_by'])){
    ?><h2 class="text-2xl font-bold mx-[4%] mt-[3%]">Films by <?php echo $_SESSION['Sort_by']; ?></h2> <?php
}else{
    ?><h2 class="text-2xl font-bold mx-[4%] mt-[3%]">Top films</h2><?php
}?>
<div class="grid grid-cols-4 justify-items-center select-none">
    @foreach($films_data->results as $film)
        <div class="filmCard m-4 text-lg shadow-2xl flex flex-col w-[58%]">
            <a href="http://ustream.test/film/{{$film->id}}">
                <h3 class="filmTitle font-bold">{{ $film->title }}</h3>
                <?php
                    $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
                    $filmNoImg = "/img/noimg.jpg";
                    $posterExists = $film->poster_path;
                    $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
                ?>
                <img src="<?= $filmImg ?>" alt="Film Poster">
            </a>
        </div>
    @endforeach
</div>

<div class="carousel-container select-none">
    <div class="inner-carousel">
        <div class="carousel-track">
        @foreach($films_data->results as $film)
        <div class="card mx-4">
            <a href="http://ustream.test/film/{{$film->id}}">
            <h3 class="filmTitle font-bold">{{ $film->title }}</h3>
            <?php
                $filmPoster = "https://image.tmdb.org/t/p/w220_and_h330_face/{$film->poster_path}";
                $filmNoImg = "/img/noimg.jpg";
                $posterExists = $film->poster_path;
                $filmImg = $posterExists == "" ? $filmNoImg : $filmPoster ;
            ?>
            <img src="<?= $filmImg ?>" alt="Film Poster">
            </a>
        </div>
    @endforeach
        </div>
    </div>
    <div class="nav">
        <button class="prev"><img class="" src="/img/larrow.svg" alt="Profil"></button>
        <button class="next"><img class="" src="/img/rarrow.svg" alt="Profil"></button>
    </div>
</div>


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
    ?><a href="<?php $actual_link ?>{{$page-1}}">Previous </a><?php
    }

if($films_data->total_pages >500){
    $max_page = 500;
}
else{
    $max_page = $films_data->total_pages;
}


    if($page != $max_page){
    ?><a href="<?php $actual_link ?>{{$page+1}}"> Next</a><?php
    }?>


<footer class="bg-grey text-yellow flex items-center gap-[10%] p-[5%]">
        <img class="w-[20%]" src="/img/logowhite.png" alt="Logo">
        <div class="w-[50vw]">
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
