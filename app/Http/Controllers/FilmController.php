<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function GetMovie ($page) {
    print_r($page);
    $api_url = 'https://api.themoviedb.org/3/discover/movie?sort_by=popularity.desc&page='.$page.'&api_key=c800206ebd27d3b6b6e7b19c646c4928';
    $json_data = file_get_contents($api_url);
    //print_r($json_data);
    $films_data = json_decode($json_data);
    //print_r($films_data);
    $films_data = $films_data->results;
    //print_r($films_data);
    foreach ($films_data as $film) {
        echo "name: ".$film->title;
        echo "<br />";
        echo "description: ".$film->overview;
        echo "<br /> <br />";
    }
}
}