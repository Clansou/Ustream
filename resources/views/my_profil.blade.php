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
                <?php if(Auth::check()){ ?>
                <a class="w-[5%]" href="http://ustream.test/signout">
                    <img class="m-2" src="/img/logout.png" alt="Logout">
                </a>
                <?php } ?>
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

    <div class="justify-around">
        <a href="http://ustream.test/my_profil">My profil</a>
        <a href="http://ustream.test/MyInvitations">My invitation</a>
        <a href="http://ustream.test/allprofils">All profils</a>
    </div>

    <h2 class="text-6xl text-yellow font-bold">Hello <?php echo Auth::user()->name?> !</h2>
    <h3><?php echo Auth::user()->email?></h3>

    <h3>My album</h3>
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
    <h3>Album share with me</h3>
    <?php $albums_share = DB::table('albums')
        ->join('albums_user_id', 'albums.id', '=' , 'albums_user_id.albums_id')
        ->select()
        ->where('albums.user_id' ,  '!=' ,  Auth::user()->id)
        ->where('albums_user_id.user_id' ,  '=' ,  Auth::user()->id)
        ->get()->all(); ?>
    @foreach($albums_share as $album)
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
    <h3>Create an album</h3>
    <form class="flex flex-col gap-3" method="post" action="{{ route('Create_Album') }}">
    @csrf
        <input type="text" placeholder="Name_of_album" id="Name" class="form-control" name="Name" required autofocus>
        <select type="text" id="Is_public" class="form-control" name="Is_public" required autofocus>  
            <option value="1">Public</option>
            <option value="0">Private</option>
        </select>
        <button type="submit" class="btn btn-dark btn-block font-semibold bg-white border-2 border-grey rounded-full px-8 py-2 hover:bg-grey hover:text-yellow">Create Album</button>
    </form>
    <h3>Share an album</h3>
    <form class="flex flex-col gap-3" method="post" action="{{ route('Share_Album') }}">
    @csrf
        <select type="text" id="id_album" class="form-control" name="id_album" required autofocus>  
            <?php   $my_albums= DB::table('albums')
            ->where('user_id', Auth::user()->id)
            ->get()->all();
            foreach($my_albums as $my_album){?>
            <option value="<?php echo $my_album->id ?>"> <?php echo $my_album->name ?></option><?php }?>
        </select>
        <select type="text" id="id_user" class="form-control" name="id_user" required autofocus>  
            <?php   $all_users= DB::table('users')
            ->where("id", "!=" , Auth::user()->id)
            ->get()->all();
            foreach($all_users as $user){?>
            <option value="<?php echo $user->id ?>"> <?php echo $user->email ?></option><?php }?>
        </select>
        <button type="submit" class="btn btn-dark btn-block font-semibold bg-white border-2 border-grey rounded-full px-8 py-2 hover:bg-grey hover:text-yellow">Share Album</button>
    </form>                             
</body>
</html>
