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

Route::get('/', function () {
    return view('welcome');
});

// auth routes
Auth::routes();
Route::get('login/{provider}', 'LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

// Question routes
Route::get('add/question', 'QuestionController@ShowQuestionAdditionForm');

Route::post('add/question', 'QuestionController@AddQuestion');

Route::get('show/question/{qid}', 'QuestionController@ShowQuestion');
