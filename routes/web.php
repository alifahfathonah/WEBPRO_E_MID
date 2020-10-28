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

Route::get('/home', 'HomeController@index')->name('home');

Route::put('/forum/{id}','AnswerController@store');

Route::patch('/forum/answer/{answer}','AnswerController@edit');
Route::post('/forum/answer/{answer}/update','AnswerController@update');
Route::delete('/forum/answer/{answer}','AnswerController@destroy');

Route::get('/forum/{question}','QuestionController@show');
Route::get('/forum','QuestionController@index');
Route::get('/forum/create','QuestionController@create');
Route::post('/forum','QuestionController@store');
Route::patch('/forum/{question}','QuestionController@edit');
Route::post('/forum/{question}/update','QuestionController@update');
Route::delete('/forum/{question}','QuestionController@destroy');
Route::post("/forum/search",'QuestionController@search');

Route::get('/question','QuestionController@showQuestion');
Route::get('/answer','AnswerController@showAnswer');

Route::get('/home', 'HomeController@index')->name('home');
