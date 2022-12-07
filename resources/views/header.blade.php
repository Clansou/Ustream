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

<header class="flex flex-col items-center px-4 py-[10vh] bg-white shadow-2xl">
    <div class="flex items-center justify-around">
        <img class="w-[20%]" src="/img/logo.png" alt="Logo">
        <div class="flex flex-row justify-end">
            <img class="w-[4%] m-2" src="/img/profil.png" alt="Profil">
            <img class="w-[4%] m-2" src="/img/home.png" alt="Home">
        </div>
    </div>
    <div class="flex items-center mt-[3%] gap-[5%]">
        <input class="p-6 h-[10vh] w-[50vw] rounded-full border-2 border-black shadow-xl italic font-semibold" type="text" placeholder="Search movie...">
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Genre</button>
            <div id="myDropdown" class="dropdown-content">
                <div class="dropdown-content-genre grid grid-cols-4 w-[100%]">
                <?php
                        $each_genres = 'https://api.themoviedb.org/3/genre/movie/list?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=FR';
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