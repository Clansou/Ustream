<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AlbumController extends Controller
{
    public function add_film_in_album($id){
        DB::table('films_in_albums')->insert($id);

        return redirect("my_profil")
            ->withSuccess(__('Film added successfully.'));
    }

    public function delete_film_in_album($id){
        DB::table('films_in_albums')->delete($id);

        return redirect("my_profil")
        ->withSuccess(__('Film deleted successfully.'));
    }
}
