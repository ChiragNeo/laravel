<?php

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('profile/update/{id}', 'ProfileController@update');

// User Controller Routes 
Route::get('user/view/{id}','UserController@view')->name('user.view');
Route::get('user/getposts','UserController@getposts')->name('user.getposts');
Route::get('user/rejected', 'UserController@rejected')->name('user.rejected');
Route::get('user/getpost','UserController@getpost')->name('user.getpost');
Route::get('user/getPostdata','UserController@getPostdata')->name('user.getPostdata');
Route::get('user/validation/{id}','UserController@validation')->name('user.validation');
Route::post('user/approve','UserController@approve')->name('user.approve');
Route::post('/user/verify/{id}','UserController@verify');
Route::post('user/search', 'UserController@search')->name('user.search');
Route::get('user/newuser','UserController@newuser')->middleware('checkuser');
Route::resource('user', 'UserController');

// REquest controller Routes

Route::get('request/getposts','RequestController@getposts')->name('request.getposts');
Route::post('/request/store','RequestController@store')->name('request.store');
Route::get('request/approve/{id}','RequestController@approve')->name('request.approve');

Route::resource('request', 'RequestController');

//Mail controller
Route::get('send','MailController@send');