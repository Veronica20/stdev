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

Route::get('/', 'GameController@game')->name('game')->middleware('CheckLogin');
Route::get('/game', 'GameController@question')->name('question')->middleware('CheckLogin');
Route::post('/game', 'GameController@answer')->name('answer')->middleware('CheckLogin');
Route::get('/score','GameController@score')->name('score');
Route::get('/noGame','GameController@noGame')->name('noGame');
Route::match(['get', 'post'], '/login', 'LoginController@login')->name('login');
Route::match(['get', 'post'], '/registration', 'LoginController@registration')->name('registration');
Route::get('/logout','LoginController@logout')->name('logout');

Route::prefix('admin')->middleware('CheckAdmin')->group(function () {

    Route::prefix('question')->group(function () {
        Route::get('/all', 'AdminController@questions')->name('questions');
        Route::post('/delete', 'AdminController@deleteQuestion')->name('deleteQuestion');
        Route::match(['get', 'post'],'/inner/{id?}', 'AdminController@innerQuestion')->where('id', '[1-9]+')->name('innerQuestion');
    });

    Route::prefix('answer/{question}')->group(function () {
        Route::get('/all', 'AdminController@answers') ->where('question', '[1-9]+')->name('answers');
        Route::post('/delete', 'AdminController@deleteAnswer')->name('deleteAnswer');
        Route::match(['get', 'post'],'/inner/{answer?}', 'AdminController@innerAnswer')->where('answer', '[1-9]+')->name('innerAnswer');
    });
});


