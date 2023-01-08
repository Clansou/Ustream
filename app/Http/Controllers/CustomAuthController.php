<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('my_profil')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        CustomAuthController::createFirstAlbum($check);
        return redirect("my_profil")->withSuccess('You have signed-in');
    }

    public function createFirstAlbum($check){
        
        $info = array(
            'name' => "Viewed",
            'user_id'=> $check['id'],
            'Is_public' => True,
        );
        $album = DB::table('albums')->insertGetId($info);
        CustomAuthController::link_user_album($check['id'],$album);
        $info = array(
            'name' => "Wish list",
            'user_id'=> $check['id'],
            'Is_public' => True,
            
        );
        $album = DB::table('albums')->insertGetId($info);
        CustomAuthController::link_user_album($check['id'],$album);
        

    }   
    public function link_user_album($user_id,$album_id){
        $info = array(
            'albums_id' => $album_id,
            'user_id' => $user_id,
        );
        DB::table('albums_user_id')->insert($info);

    }
    public function create(array $data)
    {
        
        return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
        ]);
      
    }
    
    public function get_albums($id)
    {
        return DB::table('albums')
        ->select()
        ->where('user_id' ,  '=' ,  $id)
        ->get()->all();;

    }
    public function my_profil()
    {
        if(Auth::check()){
            $id = Auth::id();
            $albums = CustomAuthController::get_albums($id);
            return view('my_profil', compact('albums'));
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
