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
            <button onclick="myFunction()" class="dropbtn bg-yellow text-grey font-semibold">Genre</button>
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
                    <option class="bg-[#f1f1f1]" value="Popularity.desc">Popularity: High to Low</option>
                    <option class="bg-[#f1f1f1]" value="Popularity Asc">Popularity: Low to High</option>
                    <option class="bg-[#f1f1f1]" value="Name.desc">Name: desc</option>
                    <option class="bg-[#f1f1f1]" value="Name.asc">Name: asc</option>
                    <option class="bg-[#f1f1f1]" value="Rank.desc">Users' rank: High to Low</option>
                    <option class="bg-[#f1f1f1]" value="Rank.asc">Users' rank: Low to High</option>
                </select>
            </div>
        </form>
    </div>
</header>
