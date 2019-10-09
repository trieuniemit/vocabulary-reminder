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

Route::get('/', 'HomeController@index');
//login
Route::get('/login', 'AuthController@getLogin')->name('login');
Route::post('/login', 'AuthController@postLogin')->name('login_post');
//sign up
Route::get('/signup', 'AuthController@getSignup')->name('signup');
Route::post('/signup', 'AuthController@postSignup')->name('signup_post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', 'UserController@getProfile')->name('profile'); //edit profile
    Route::get('/logout', 'UserController@logout')->name('logout');


    Route::prefix('vocabularymanager')->group(function() {
        Route::get('/', function() {
            return view('VocabularyManager');
        })->name('vocabulary-manager');
        Route::get('getandfill', 'VocabularyController@getandfill');
        Route::post('edit/{id}', 'VocabularyController@edit');
        Route::post('delete/{id}', 'VocabularyController@delete');
    });

});

Route::get('/vocabulary', 'HomeController@vocabulary');

