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

Route::get('/user', 'userController@showAll');
Route::get('/user/{user}', 'userController@show');


Route::get('/login', 'loginController@index');
Route::post('/login/enter', 'loginController@enter');


Route::get('/signup', 'signupController@index');
Route::post('/signup', 'signupController@register');

Route::post('/placeappointments', 'AppointmentsController@index');
Route::post('/placeappointments/{user}', 'AppointmentsController@register');
Route::get('logout', 'Auth\LoginController@logout');

Route::get('bootstrap', function ()
{
	return view('layout');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
