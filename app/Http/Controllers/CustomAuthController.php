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
         
        return redirect("my_profil")->withSuccess('You have signed-in');
    }

    public function createFirstAlbum(){
        $data = array(
            'name' => "Viewed",
            'user_id' => Auth::id(),
            'state' => 1,
            'modify' => false,
        );
        DB::table('albums')->insert($data);
        $data = array(
            'name' => "Wish list",
            'user_id' => Auth::id(),
            'state' => 1,
            'modify' => false,
        );
        DB::table('albums')->insert($data);
    }   

    public function create(array $data)
    {
        CustomAuthController::createFirstAlbum();
        return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
        ]);
      
    }
    
    
    public function my_profil()
    {
        if(Auth::check()){
            return view('my_profil');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
