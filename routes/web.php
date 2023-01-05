<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AlbumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/films/{page}',[FilmController::class, 'GetMovies']);

Route::get('/films/{genre}/{page}',[FilmController::class, 'GetMoviesByGenres']);

Route::get('/film/{id_film}',[FilmController::class, 'GetMovie']);

Route::get('/my_profil', [CustomAuthController::class, 'my_profil'])->name('/my_profil'); 
Route::get('/login', [CustomAuthController::class, 'index'])->name('/login');
Route::post('/custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('/registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('/custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('/signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::delete('/delete_film_in_album/{id}', [AlbumController::class, 'delete_film_in_album'])->name('delete_film_in_album'); 
