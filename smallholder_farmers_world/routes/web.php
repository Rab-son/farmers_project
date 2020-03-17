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

Route::match(['get','post'], '/admin','AdminController@login');// Route for admin login
Route::get('/logout','AdminController@logout');// Route for admin logout

//Securing dashboard routes using middleware
Route::group(['middleware' => ['auth']], function(){

    Route::get('/admin/dashboard','AdminController@dashboard');// Route for admin dashboard
    Route::get('/admin/settings','AdminController@settings');// Route for settings
    Route::get('/admin/check-pwd', 'AdminController@chckPassword');// Route for checking password
    Route::match(['get','post'], '/admin/update-pwd', 'AdminController@updatePassword');// Route for updating password
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
