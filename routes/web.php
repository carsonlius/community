<?php

Route::get('/', 'DiscussController@index');

Route::group(['prefix' => 'user'], function(){
    Route::get('/register', 'UserController@register');
    Route::get('/verify/{confirm_code}', 'UserController@verifyEmail');
    Route::get('/showAvatar', 'UserController@showAvatar');

    Route::post('/storeAvatar', 'UserController@storeAvatar');
    Route::post('/register', 'UserController@store');
    Route::post('/sign', 'UserController@sign');
});

// login logout
Route::get('/login', 'UserController@login')->name('login');
Route::post('/logout', 'UserController@logout')->name('logout');

// discussion route
Route::resource('/discussions', 'DiscussController');

// comments route
Route::resource('/comments', 'CommentController');

// show email result
Route::get('/email_show', function(){
    $obj_user = \App\User::find(1);
    return new \App\Mail\UserEmailVerify($obj_user);
});

// crop img
Route::post('/crop/api', 'UserController@cropAvatar');
