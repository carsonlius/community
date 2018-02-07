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

Route::get('/user/register', 'UserController@register');

Route::post('/user/register', 'UserController@store');

Route::get('/verify/{confirm_code}', 'UserController@verifyEmail');


Route::get('/mail', function(){
    $user_obj = \App\User::find(43);
    $obj_email = new \App\Mail\UserEmailVerify($user_obj);
//    \Mail::to($user_obj->email)->queue($obj_email->onQueue('user_email_verify'));
    return new \App\Mail\UserEmailVerify($user_obj);
});
