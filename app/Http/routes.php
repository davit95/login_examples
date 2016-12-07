<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/','Auth\AuthController@getLogin');
Route::get('/home', 'HomeController@index');

/*login and logout routes*/

//Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

/*end login and logout routes*/

/*registration routes*/

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/* end registration routes*/

/*password reset routes*/

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::get('/book', function(){
   return view('book');
});
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

/*end password reset routes*/

/*social routes*/

Route::get('fb-login', 'Facebook\FacebookController@fbLogin');
Route::get('fb-callback', 'Facebook\FacebookController@callback');
Route::get('twitter/login', 'Twitter\TwitterController@twitterLogin');
Route::get('twitter/callback', 'Twitter\TwitterController@callback');
Route::get('google/login', 'Google\GoogleController@googleLogin');
Route::get('google/callback', 'Google\GoogleController@callback');

Route::get('/google-analytics', 'GoogleAnalyticsController@index');

/*end social routes*/

Route::resource('categories', 'CategoriesController');
Route::resource('users', 'UsersController');

Route::get('add-user', 'UsersController@addUser');

Route::get('avo-centers', 'CentersController@getAvoCenters');

Route::get('/test/{locale}', 'TestController@index');
Route::get('/test/{locale}/get-paragraph', 'TestController@getParagraph');



