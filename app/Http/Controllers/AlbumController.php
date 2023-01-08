<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
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
    public function CreateAlbum(Request $request){
        if($request->validate([
            'Name' => 'required',
            'Is_public' => 'required',
        ])){
            $info = array(
                'name' => $request['Name'],
                'user_id'=> Auth::user()->id,
                'Is_public' => $request['Is_public'],
            );
            if($album = DB::table('albums')->insertGetId($info)){
                app('App\Http\Controllers\CustomAuthController')->link_user_album(Auth::user()->id,$album);
                return redirect("my_profil")->withSuccess('Album Create');
            };
            
        };
    }
    public function ShareAlbum(Request $request){
        $info = array(
            'user_id' => $request['id_user'],
            'albums_id' => $request['id_album']
        );
        if($album = DB::table('albums_user_id')->insertGetId($info)){
            return redirect("my_profil")->withSuccess('Album Share');
        };
    }
}
