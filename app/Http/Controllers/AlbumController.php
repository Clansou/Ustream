<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AlbumController extends Controller
{
    public function delete_film_in_album($id){
        DB::table('films_in_albums')->delete($id);

        return redirect("my_profil")
        ->withSuccess(__('Film delete successfully.'));
    }
}
