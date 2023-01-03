<?php

namespace App\Http\Controllers;
?> <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  <?php
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function GetMovies ($page) {



        if(is_numeric($page)){

        }else{
            header('Location: http://ustream.test/films/1');
        exit();
        }
    //print_r($page);


    if($page > 500){
        header('Location: http://ustream.test/films/500');
        exit();
    }




    return view('films',['page' => $page]);



}

    public function GetMoviesByGenres($genre , $page) {
        if(is_numeric($page)){

        }else{
            header('Location: http://ustream.test/films/'.$genre.'/1');
            exit();
        }

        $each_genres = 'https://api.themoviedb.org/3/genre/movie/list?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=EN';
        $each_genres = file_get_contents($each_genres);
        $each_genres = json_decode($each_genres);
        $each_genres = $each_genres->genres;
        //print_r($each_genres);
        $genre_id = 0;
        foreach ($each_genres as $each_genre) {
            //print_r($each_genre->name);
            if(strtolower($each_genre->name) == $genre){
                $genre_id = $each_genre->id;
            }
        }
        if($genre_id == 0){
            header('Location: http://ustream.test/films/1');
            exit();
        }
        //print_r($genre_id);
        //print_r($genre);
        //print_r($page);
        if($page > 500){
            header('Location: http://ustream.test/films/'.$genre.'/500');
            exit();
        }




        $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&with_genres='.$genre_id.'&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
        $json_data = file_get_contents($api_url);
        //print_r($json_data);
        $films_data = json_decode($json_data);
        //print_r($films_data);
        $film_data = $films_data->results;
        //print_r($film_data);


        if($films_data->total_pages < 500){
            $max_page = $films_data->total_pages;
        }else{
            $max_page = 500;
        }
        if($page > $max_page){
            header('Location: http://ustream.test/films/'.$genre.'/'.$max_page);
            exit();
        }




    return view('films',['genre_id' => $genre_id , 'page' => $page]);
    }

    public function GetMovie($id_film){
        return view('film',['id_film' => $id_film]);
    }
}
