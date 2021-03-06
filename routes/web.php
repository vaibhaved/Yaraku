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

Route::get('/', 'PageController@index');

Route::post('/export', 'PageController@export');

//Route to return books data.
Route::resource('/', 'BooksController');

Route::delete('/{id}', 'BooksController@destroy');

Route::put('/{id}', 'BooksController@update');

Route::get('/sort', 'BooksController@sort');