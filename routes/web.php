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
    if(Auth::check())
    {
      return redirect('/home');
    }
    return redirect('/login');
});

// auth routes
Auth::routes();
Route::get('login/{provider}', 'LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'HomeController@displayProfile')->name('Profile');
Route::post('/profile', 'HomeController@updateProfile');

// Question routes
Route::get('add/question', 'QuestionController@ShowQuestionAdditionForm');

Route::post('add/question', 'QuestionController@AddQuestion');

Route::post('add/answer/{qid}', 'QuestionController@submitAnswer');

Route::get('show/question/{qid}', 'QuestionController@ShowQuestion');

// retrive the image files
Route::get('/retrive/images/{filename}', function ($filename)
{
    // if(!File::exists($path)) abort(404);
    $contents = Storage::get('images/'.$filename);
    $extensions = explode('.', $filename);
    $type = $extensions[1];

    $response = Response::make($contents, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('list/question','Controller@getRecentQuestionList');

Route::get('list/question/recent','Controller@getRecentQuestionList');
