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

    <div class="flex justify-around text-3xl font-bold my-8 text-center">
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/my_profil">My profil</a>
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/MyInvitations">My invitations</a>
        <a class="bg-lightGrey border-2 border-grey px-8 py-2 hover:bg-grey hover:text-yellow" href="http://ustream.test/allprofils">All profils</a>
    </div>

    <h1 class="text-6xl text-yellow font-bold text-center my-4">Profil of <?php echo $user_info->name ?></h1>
    <h2 class="text-4xl text-grey font-bold m-4"><?php echo $user_info->name ?>'s albums</h2>
    <?php
    $albums = DB::table('albums')
    ->select()
    ->where('user_id' ,  '=' ,   $user_info->id)
    ->where('Is_public' , '=' , '1')
    ->get()->all();
    ?>


    @foreach($albums as $album)
        <div class="bg-yellow p-6 m-4 rounded-2xl">
            <div class="flex items-center">
                <form class="flex flex-col gap-3" method="post" action="{{ route('Like_Album') }}">
                    @csrf
                    <input id="album_id" name="album_id" type="hidden" value="<?php echo $album->id ?>">
                    <input id="user_id" name="user_id" type="hidden" value="<?php echo $user_info->id ?>">
                    <button type="submit">
                        <?php if( DB::table('_liked__album')->where('user_id', '=' ,  Auth::user()->id)->where('albums_id', '=', $album->id)->count() >=1){
                            ?><img id="likeIcon" class="w-[50px] m-2" src="/img/heartRed.svg" alt="Add Movie To Playslist"><?php
                        }else{
                            ?><img id="likeIcon" class="w-[50px] m-2" src="/img/heartBlack.svg" alt="Add Movie To Playslist">
                        <?php } ?>

                    </button>
                </form>
                <h3 class="text-2xl text-grey font-bold m-2 underline">{{$album->name}}</h3>
            </div>

            <?php
            $films= DB::table('films_in_albums')
            ->where('albums_id', $album->id)
            ->get()->all(); ?>
            <div class="gridFilms justify-items-center select-none">
              <?php foreach($films as $film_in_album){
                $api_url = 'https://api.themoviedb.org/3/movie/'.$film_in_album->films_id.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
                $json_data = file_get_contents($api_url);
                $film = json_decode($json_data);
                ?>
                <div class="filmCard m-4 text-lg shadow-2xl flex flex-col">
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
            <?php } ?>
            </div>
        </div>
    @endforeach



    <?php $albums_liked = DB::table('albums')
    ->select()
    ->join('_liked__album', 'albums.id', '=' , '_liked__album.albums_id')
    ->where('_liked__album.user_id' ,  '=' ,   $user_info->id)
    ->get()->all();
    ?>
    <h2 class="text-4xl text-grey font-bold m-4">Album liked by <?php echo $user_info->name ?></h2>
    @foreach($albums_liked as $album)
        <div class="bg-lightGrey p-6 m-4 rounded-2xl">
            <h3 class="text-2xl text-yellow font-bold m-2 underline">{{$album->name}}</h3>
            <?php
            $films= DB::table('films_in_albums')
            ->where('albums_id', $album->albums_id)
            ->get()->all(); ?>
            <div class="gridFilms justify-items-center select-none">
                <?php foreach($films as $film_in_album){
                    $api_url = 'https://api.themoviedb.org/3/movie/'.$film_in_album->films_id.'?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
                    $json_data = file_get_contents($api_url);
                    $film = json_decode($json_data); ?>
                    <div class="filmCard m-4 text-lg shadow-2xl flex flex-col">
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
                <?php } ?>
            </div>
        </div>
    @endforeach


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
