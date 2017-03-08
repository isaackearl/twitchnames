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


Auth::routes();

Route::get('/', 'HomeController@index');

// ajax

Route::group(['middleware' => ['auth']], function () {
    //
    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('usernames/search', 'UsernameController@search');
    Route::get('usernames', 'UsernameController@index');
    Route::post('usernames', 'UsernameController@store');
    Route::delete('usernames/{username}', 'UsernameController@destroy');
});
