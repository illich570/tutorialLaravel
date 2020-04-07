<?php
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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

Route::get('/',function() {
  return view('welcome');
});

Auth::routes(['verify'=>true]);


Route::group(['middleware'=>'verified'],function() {

  Route::get('/home', 'HomeController@index')->name('home');
  Route::resource('posts','PostController');
  Route::get('/paypal', function() {
    return Payment::doSomething();
  });
  Route::get('/my/posts','PostController@myPosts')->name('posts.my');
});

use App\Jobs\UserEmailWelcome;

Route::get('/mail',function(){
  UserEmailWelcome::dispatch(App\User::find(1));
  return 'done';
});