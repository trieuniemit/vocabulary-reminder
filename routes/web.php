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


Route::get('/redirect/{social}', 'SocialAuthController@redirect');
Route::get('/callback/{social}', 'SocialAuthController@callback');

//must be login
Route::middleware('auth')->group(function () {


    //feature for user
    Route::group(['prefix' => 'user'], function() {
        Route::get('/', function() {
            return redirect(route('user_remind'));
        });

        //hoang thuc
        Route::get('/remind', 'User\RemindController@index')->name('user_remind');
        Route::post('/remind', 'User\RemindController@create')->name('remind_post');
        Route::delete('/remind', 'User\RemindController@delete')->name('remind_delete');

        //niem
        Route::get('/dictionary', 'User\HomeController@vocabularies')->name('user_dictionary');
        Route::get('/dictionary/{word}', 'User\HomeController@vocabularyDetail')->name('user_vocabulary_detail');
        Route::get('/profile', 'User\HomeController@getUserProfile')->name('user_profile'); //edit profile
        Route::post('/profile', 'User\HomeController@postUserProfile')->name('user_profile_post'); //edit profile
        Route::prefix('vocabularymanager')->group(function() {
            Route::get('/', function() {
                return view('user/Vocabulary_Manager_fuser');
            })->name('vocabulary-manager-fuser');
            Route::get('getandfill', 'VocabularyController@getandfill');
            Route::post('edit/{id}', 'VocabularyController@edit');
            Route::post('delete/{id}', 'VocabularyController@delete');
        });
    });

    Route::prefix('admin')->group(function() {
        Route::get('/', 'Admin\UserController@index')->name('admin_home');
        //admin_setting
        Route::get('/settings', 'Admin\SystemController@index')->name('admin_setting');
        Route::post('/settings', 'Admin\SystemController@postSetting');
        Route::resource('/users', 'Admin\UserController');
        //for notification
        Route::get('/getselect', 'Admin\UserController@getaselect');
        //for manager
        Route::prefix('vocabularymanager')->group(function() {
            Route::get('/', function() {
                return view('admin/Vocabulary_Manager');
            })->name('vocabulary-manager');
            Route::get('getandfill', 'VocabularyController@getandfill');
            Route::post('edit/{id}', 'VocabularyController@edit');
            Route::post('delete/{id}', 'VocabularyController@delete');
        });

        Route::prefix('notificationmanager')->group(function() {
            Route::get('/',function (){
                return view('admin/notification');
            })->name('notification-manager');
            Route::get('getandfill', 'SendNotificationController@getandfill');
            Route::post('edit', 'SendNotificationController@edit');
            Route::post('delete/{id}', 'SendNotificationController@delete');
        });
    });
    //Dũng
    //    Route::get('notification', 'SendNotificationController@create')->name('notification.create');
    //    Route::post('notification', 'SendNotificationController@store')->name('notification.store');
    //!
    Route::get('/logout', 'AuthController@logout')->name('logout');
});

//for guest
Route::get('/vocabularies', 'HomeController@vocabulary')->name('vocabularies');
Route::get('/quick_search', 'HomeController@quickSearch')->name('quick_search');
Route::get('/vocabularies/{word}', 'HomeController@vocabularyDetail')->name('home_vocabulary_detail');
