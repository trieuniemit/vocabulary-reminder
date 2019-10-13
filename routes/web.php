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

//must be login
Route::middleware('auth')->group(function () {
    Route::prefix('vocabularymanager')->group(function() {
        Route::get('/', function() {
            return view('VocabularyManager');
        })->name('vocabulary-manager');
        Route::get('getandfill', 'VocabularyController@getandfill');
        Route::post('edit/{id}', 'VocabularyController@edit');
        Route::post('delete/{id}', 'VocabularyController@delete');
    });

    //feature for user
    Route::group(['prefix' => 'user'], function() {
        Route::get('/remind', 'RemindController@getRemind')->name('user_remind');
        Route::get('/dictionary', 'User\HomeController@vocabularies')->name('user_dictionary');
        Route::get('/dictionary/{word}', 'User\HomeController@vocabularyDetail')->name('user_vocabulary_detail');
        Route::get('/profile', 'User\HomeController@getUserProfile')->name('user_profile'); //edit profile
    });

    Route::prefix('admin')->group(function() {
        Route::get('/', 'Admin\AdminController@index')->name('admin_home');
    });

    Route::get('/logout', 'AuthController@logout')->name('logout');
});

//for guest
Route::get('/vocabularies', 'HomeController@vocabulary')->name('vocabularies');
Route::get('/quick_search', 'HomeController@quickSearch')->name('quick_search');
Route::get('/vocabularies/{word}', 'HomeController@vocabularyDetail')->name('home_vocabulary_detail');
