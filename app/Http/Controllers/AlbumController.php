<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class AlbumController extends Controller
{
    public function add_film_in_album(Request $request){
        $info = array(
            'films_id' => $request['id_film'],
            'albums_id' => $request['id_album']
        );
        if(DB::table('films_in_albums')->insert($info)){
            return redirect()->back()->withSuccess('Album Added');
        };
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
        if($request['Accept'] == 1){
            DB::table('albums_user_id')->insert($info);
        }
        DB::table('invitation')->delete($request['id']);
        return redirect("my_profil")->withSuccess('Album Shared');
    }
    public function InviteAlbum(Request $request){
        $info = array(
            'albums_id' => $request['id_album'],
            'user_id_inviter' => Auth::user()->id,
            'user_id_invited' => $request['id_user'],

        );
        if(DB::table('invitation')->insert($info)){
            return redirect("my_profil")->withSuccess('Album Share');
        };

    }
    public function LikeAlbum(Request $request){
        if(Auth::check()){
            $liked = DB::table('_liked__album')->where('user_id', '=' ,  Auth::user()->id)->where('albums_id', '=', $request['album_id'])->count();
            if($liked>=1){
                DB::table('_liked__album')->where('user_id', '=' ,  Auth::user()->id)->where('albums_id', '=', $request['album_id'])->delete();
                return redirect()->back();
            }
            else{
                $info = array(
                    'user_id' => Auth::user()->id,
                    'albums_id' => $request['album_id']
                );
                if(DB::table('_liked__album')->insert($info)){
                    return redirect()->back();
                };
            }
        }
    }
}
