<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;


use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

// Route::get('/welcome',function(){
//     return view('welcome');
// });


Route::get('/chat',[App\Http\Controllers\MessageController::class, 'getchat'])->name('getchat');
Route::get('/chat/{id}',[App\Http\Controllers\MessageController::class, 'getmessages'])->name('getmessages');
Route::post('/sendmessage',[App\Http\Controllers\MessageController::class, 'sendmessage'])->name('sendmessage');

Route::get('/welcome', [App\Http\Controllers\MessageController::class, 'welcome'])->name('welcome');





Route::get('/profile/{id}',[App\Http\Controllers\ProfileController::class, 'profile'])->name('profile');
Route::get('/profile/edite/{id}',[App\Http\Controllers\ProfileController::class, 'edite'])->name('edite');
Route::patch('/profile/{id}',[App\Http\Controllers\ProfileController::class, 'update'])->name('update');

Route::get('/welcome/{id}',[App\Http\Controllers\ProfileController::class, 'welcome'])->name('welcome');

Route::get('/test',function(){
    return view('test');
});


Route::get('/follow/{id}',[App\Http\Controllers\FollowController::class, 'follow']);


Route::get('/post/create',[App\Http\Controllers\PostController::class, 'create'])->name('create');
Route::post('/post',[App\Http\Controllers\PostController::class, 'store'])->name('store');
Route::get('/profile/post/{post}',[App\Http\Controllers\PostController::class, 'show'])->name('show');

Route::get('/Online/{id}', [App\Http\Controllers\UserOnlineController::class, 'online'])->name('online');
Route::get('/Offline/{id}', [App\Http\Controllers\UserOnlineController::class, 'offline'])->name('offline');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/create/comment/{id}',[App\Http\Controllers\HomeController::class, 'create_comment'])->name('create_comment');
Route::get('/home/show_post/{post_id}',[App\Http\Controllers\HomeController::class, 'pop_up_post'])->name('pop_up_post');
Route::get('/home/create/like/{post_id}',[App\Http\Controllers\HomeController::class, 'create_like'])->name('create_like');
Route::get('/home/search/{search}',[App\Http\Controllers\HomeController::class, 'search'])->name('search');




