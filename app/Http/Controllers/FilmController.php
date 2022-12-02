<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function GetMovie ($page) {
    //print_r($page);
    $page_next = $page + 1;
    $page_previous = $page -1;

    $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
    $json_data = file_get_contents($api_url);
    //print_r($json_data);
    $films_data = json_decode($json_data);
    //print_r($films_data);
    $film_data = $films_data->results;
    //print_r($film_data);
    foreach ($film_data as $film) {
        echo "name: ".$film->title;
        echo "<br />";
        echo "description: ".$film->overview;
        echo "<br /> <br />";
    }
    if($page_previous != 0){
        echo "<a href=http://ustream.test/films/".$page_previous."> previous page";
    }
    if($page_next != 501){ //501 car on peut pas aller au dessus je sais pas pourquoi
       echo "<a href=http://ustream.test/films/".$page_next."> next page";
    }
    
}

    public function GetMovieByGenre($genre , $page) {
        $each_genres = 'https://api.themoviedb.org/3/genre/movie/list?api_key=c800206ebd27d3b6b6e7b19c646c4928&language=FR';
        $each_genres = file_get_contents($each_genres);
        $each_genres = json_decode($each_genres);
        $each_genres= $each_genres->genres;
        //print_r($each_genres);
        $genre_id = 0;
        foreach ($each_genres as $each_genre) {
            print_r($each_genre->name);
            if(strtolower($each_genre->name) == $genre){
                $genre_id = $each_genre->id;
            }
        }
        //print_r($genre_id);
        //print_r($genre);
        //print_r($page);
        $page_next = $page + 1;
        $page_previous = $page -1;

        $api_url = 'https://api.themoviedb.org/3/discover/movie?&with_genres='.$genre_id.'&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
        $json_data = file_get_contents($api_url);
        //print_r($json_data);
        $films_data = json_decode($json_data);
        //print_r($films_data);
        $film_data = $films_data->results;
        //print_r($film_data);
        foreach ($film_data as $film) {
            echo "name: ".$film->title;
            echo "<br />";
            echo "description: ".$film->overview;
            echo "<br /> <br />";
        }
        if($films_data->total_pages < 500){
            $max_page = $films_data->total_pages;
        }else{
            $max_page = 500;
        }
        print_r($max_page);
        if($page_previous != 0){
            echo "<a href=http://ustream.test/films/".$genre."/".$page_previous."> previous page";
        }
        if($page_next != $max_page+1){ //501 car on peut pas aller au dessus je sais pas pourquoi
        echo "<a href=http://ustream.test/films/".$genre."/".$page_next."> next page";
        }
        
    }
}