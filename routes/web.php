<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'WelcomeController@index');

Auth::routes(['verify' => true]);

Route::get('/search', 'SearchController@search');

Route::resource('questions', 'QuestionsController');
Route::get('/tag/{tag:name}', 'QuestionsController@tagView');
Route::get('/field/{field:name}', 'QuestionsController@fieldView');
Route::get('/course/{course:name}', 'QuestionsController@courseView');

Route::resource('profile', 'ProfilesController');

Route::post('/answers/{id}/{question_title}', 'AnswersController@store')->name('answers.store');
Route::resource('answers', 'AnswersController')->except('store');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/deactivate', 'DashboardController@deactivate')->name('confirm')->middleware(['auth', 'password.confirm']);

Route::get('/reactivate', 'ReactivateAccountController@reactivate');
Route::post('/reactivate', 'ReactivateAccountController@authenticate')->name('reactivate');

Route::delete('/deactivate/{user}', 'DeactivateAccountController@destroy')->name('deactivate');
Route::delete('/deleteAccount/{user}', 'DeleteAccountController@deleteAccount')->name('deleteAccount');

//Route::get('/email', function () {
//    \Illuminate\Support\Facades\Mail::to('test@test.com')->send(new \App\Mail\WelcomeMail());
//
//   return new \App\Mail\WelcomeMail();
//});
