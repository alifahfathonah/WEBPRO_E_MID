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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::put('/forum/{id}','AnswerController@store');

Route::get('/forum/answer/{answer}','AnswerController@edit');
Route::post('/forum/answer/{answer}/update','AnswerController@update');

Route::get('/forum/create','QuestionController@create');
Route::post('/forum','QuestionController@store');
Route::patch('/forum/{question}','QuestionController@edit');
Route::post('/forum/{question}/update','QuestionController@update');
Route::delete('/forum/{question}','QuestionController@destroy');

Route::get('/home', 'HomeController@index')->name('home');
