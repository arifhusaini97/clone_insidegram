<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

// This is not working! Why?
// Route::get('/p', 'PostsController@create');

// Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

// this two is conflicting. So, position is important.
// Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);
// Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);

// For testing purpose
// Route::post('follow/{user}', function(){
//     return ['success'];
// });

Route::post('follow/{user}',  [App\Http\Controllers\FollowsController::class, 'store']);

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);

Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');

Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
