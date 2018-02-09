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

Route::get('/', 'PostController@index');

Route::resource('/discussions', 'DiscussController');


Route::group(['prefix' => 'user'], function(){
    Route::get('/register', 'UserController@register');
    Route::post('/register', 'UserController@store');
    Route::get('/verify/{confirm_code}', 'UserController@verifyEmail');
    Route::get('/login', 'UserController@login');

});

Route::get('/email_show', function(){

    $obj_user = \App\User::find(1);
    return new \App\Mail\UserEmailVerify($obj_user);
});


