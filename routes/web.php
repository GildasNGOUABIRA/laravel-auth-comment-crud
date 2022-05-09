<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

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

Route::resource('comment', CommentController::class)->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');

Route::get('/changestatus/{id}', [UserController::class,'changestatus'])->middleware(['auth','role:admin']);

// Route::group(['middleware' => ['auth','role:admin']], function() {
//     Route::get('/enable-account/{id}', 'App\Http\Controllers\UserController@enable')->name('user.enable');
//     Route::get('/disable-account/{id}', 'App\Http\Controllers\UserController@disable')->name('user.disable');
// });


//auth route for both
Route::group(['middleware' => ['auth']], function() {
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
});

// for users
Route::group(['middleware' => ['auth', 'role:user']], function() {
    Route::get('/dashboard/myprofile', 'App\Http\Controllers\DashboardController@myprofile')->name('dashboard.myprofile');
});

// for blogwriters
Route::group(['middleware' => ['auth', 'role:blogwriter']], function() {
    Route::get('/dashboard/postcreate', 'App\Http\Controllers\DashboardController@postcreate')->name('dashboard.postcreate');
});


require __DIR__.'/auth.php';
