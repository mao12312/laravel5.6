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
use App\Book;
use Illuminate\Http\Request;

//ホーム画面
Route::get('/','Bookscontroller@index');

//bookdashboard画面
Route::get('/dashboard','BooksController@dashboard');

//welcomeページ
Route::get('/welcome', 'Bookscontroller@welcome');

//登録ページ
Route::post('/books', 'BooksController@store');

//削除
Route::delete('/book/{book}', 'BooksController@delete');

//更新機能
//Book booksのid値を取得
Route::post('/booksedit/{books}', 'BooksController@booksedit');

//更新ページ
Route::post('/books/update', 'BooksController@update');
