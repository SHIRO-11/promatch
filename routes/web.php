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

Route::get('/','MicropostsController@index')->name('/');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController'); 
    Route::resource('chat', 'ChatController');
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
    Route::get('microposts/all','MicropostsController@all')->name('microposts.all');
    
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
