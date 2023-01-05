<!DOCTYPE html>
<html>
<head>
    <title>Custom Auth in Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
            }
           
            ?>

        </div>
    @endforeach
</body>
</html>