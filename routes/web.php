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
    $selected_date = date('Y-m-d');
    return view('welcome', compact('selected_date'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/history', 'HomeController@history')->name('home.history');
Route::post('/home/cancel', 'HomeController@cancel')->name('home.cancel');

//學生購課
Route::post('/home/add', 'HomeController@add')->name('home.add');

//學生選課
Route::get('/course/select/{selected_date}', 'CourseController@select')->name('course.select');
Route::post('/course/select/{selected_date}', 'CourseController@post')->name('course.post');
Route::post('/courses/select/{selected_date}', 'CourseController@book')->name('course.book');

//老師查課
Route::get('/course', 'CourseController@course')->name('course.course');

//老師刪課
Route::post('/course/delete', 'CourseController@delete')->name('course.delete');

//老師開課
Route::get('/course/creates', 'CourseController@creates')->name('course.creates');
Route::get('/course/create/{firstDate}', 'CourseController@create')->name('course.create')->middleware('can:admin');
Route::post('/course', 'CourseController@open')->name('course.open');
Route::post('/courses/create/{firstDate}', 'CourseController@tpost')->name('course.tpost');