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


// discussion route
Route::resource('/discussions', 'DiscussController');
Route::post('/discussions/editFile', 'DiscussController@editFile');

// favorite discussion
//Route::post('/favorite/store', 'FavoriteController@store');
Route::resource('/favorite', 'FavoriteController');

// english chinese
Route::get('En', 'DiscussController@En');

// comments route
Route::resource('/comments', 'CommentController');

// show email result
Route::get('/email_show', function(){
    $obj_user = \App\User::find(1);
    return new \App\Mail\UserEmailVerify($obj_user);
});

// crop img
Route::post('/crop/api', 'UserController@cropAvatar');

// login logout
Route::get('/login', 'UserController@login')->name('login');
Route::post('/logout', 'UserController@logout')->name('logout');

// github登录
Route::get('/github/login', 'UserController@githubLogin');
Route::get('/github/callback', 'UserController@githubCallback');

Route::get('/test', function(){
    $social_id = '1111';
    $social_type = 'hello world';
    dd(compact('social_id', 'social_type'));
    dump(config());
    dd(config('app'));
});