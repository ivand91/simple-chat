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
Route::get('/', function() {
    return redirect('/login'); 
});

Route::get('/register', 'AuthController@showRegister');
Route::post('/register', 'AuthController@register');
Route::get('/login', 'AuthController@showLogin')->name('login');
Route::post('/login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function() {
    Route::view('/room', 'chat');
    Route::get('/logout', 'AuthController@logout');
});