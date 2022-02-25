<?php

use Illuminate\Support\Facades\Route;


//namespaces
use App\Http\Controllers\UserController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\AbilityController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\CustompokeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\PokedexController;
use App\Http\Controllers\SearchController;


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
    return redirect('/login');
});


Auth::routes(['verify' => true]);

//User Routes

Route::resource('/user', UserController::class);

//Home Route

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Pokemon Routes

Route::resource('/pokemon', PokemonController::class);

//Properties Routes

Route::resource('/ability', AbilityController::class);
Route::resource('/type', TypeController::class);
Route::resource('/specie', SpecieController::class);

//CustomPoke Routes

Route::resource('/custompoke', CustompokeController::class);

//Imagen Routes

Route::resource('/image', ImageController::class);

//Pokedex Routes

Route::get('/pokedex/{pokedex}', [PokedexController::class, 'show'])->name('pokedex');

//Change User data by Admin Route

Route::get('/edituser/{user}/edit', [UserController::class, 'editUser'])->name('admin.edit.user');
Route::put('/edituser/{user}', [UserController::class, 'updateUser'])->name('admin.update.user');

//Search Route

Route::get('/search/', [SearchController::class, 'search'])->name('search');