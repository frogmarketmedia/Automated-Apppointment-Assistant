<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', 'userController@showAll');
Route::get('/user/{user}', 'userController@show');

Route::get('/new', 'userController@index');

Route::post('/user', 'userController@showSearched');

Route::get('/user/{user}/edit', 'EditController@edit');
Route::post('/user/{user}/edit', 'EditController@update');

Route::post('/user/deleteappointment/{user}','EditController@deleteAppointment');
Route::post('/user/updateappointment/{user}/updated','EditController@updateAppointment');
Route::post('/user/updateappointment/{user}','EditController@updateAppointmentindex');

Route::post('/user/profilepicupdated','userController@update_photo');


Route::get('/login', 'loginController@index');
Route::post('/login/enter', 'loginController@enter');

Route::get('/createEvent', 'gCalendarController@create');


Route::get('/signup', 'signupController@index');
Route::post('/signup', 'signupController@register');

Route::get('/placeappointments/{user}', 'AppointmentsController@index');
Route::post('/placeappointments/{user}', 'AppointmentsController@makeAppointment');

Route::post('/setrating/{user}', 'PriorityController@setRating');

Route::get('logout', 'Auth\LoginController@logout');

Route::get('bootstrap', function ()
{
	return view('layout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();
Route::resource('gcalendar', 'gCalendarController');
Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'gCalendarController@oauth']);
Route::get('gc/{appointment}','gCalendarController@store');
