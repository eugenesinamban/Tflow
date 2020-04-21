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

Route::get('/', 'PagesController@index');

Auth::routes();

Route::get('/search', 'SearchController@search');
Route::resource('questions', 'QuestionsController');
Route::get('/tag/{tag:name}', 'QuestionsController@tagView');
Route::resource('profile', 'ProfilesController');
Route::resource('answers', 'AnswersController')->except('store');
Route::post('/answers/{id}/{question_title}', 'AnswersController@store')->name('answers.store');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
