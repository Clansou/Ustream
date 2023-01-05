<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/public/img/favicon.png">
    <title>My Profil - Ustream</title>
    <link rel="stylesheet" href="/app.css">
    @vite('public/app.css')
</head>

<body>
    <header class="flex flex-col items-center px-4 py-[10vh] bg-white shadow-2xl">
        <div class="flex items-center justify-around">
            <a class="w-[20%]" href="http://ustream.test/films/1">
                <img src="/img/logo.png" alt="Logo">
            </a>
            <div class="flex flex-row justify-end gap-8">
                <a class="w-[5%]" href="http://ustream.test/my_profil">
                    <img class="m-2" src="/img/profil.png" alt="Profil">
                </a>
                <a class="w-[5%]" href="http://ustream.test/signout">
                    <img class="m-2" src="/img/logout.png" alt="Logout">
                </a>
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
    <li class="nav-item">
        <a class="nav-link" href="{{ route('signout') }}">Logout</a>
    </li>
    <h1><?php echo Auth::user()->id?></h1>
    <h2><?php echo Auth::user()->name?></h2>
    <h3><?php echo Auth::user()->email?></h3>

    @foreach($albums as $album)
        <div class="album">
            <h3>{{$album->name}}</h3>
            <?php
            $films= DB::table('films_in_albums')
            ->where('albums_id', $album->id)
            ->get()->all();
            foreach($films as $film_in_album){
                $api_url = 'https://api.themoviedb.org/3/movie/'.$film_in_album->films_id.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
                $json_data = file_get_contents($api_url);
                $film = json_decode($json_data);
                print_r($film);
                print_r($film_in_album->id);
                ?>{!!Form::open(['url' => ['delete_film_in_album',$film_in_album->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}<?php
            }?>
        </div>
    @endforeach
</body>
</html>
