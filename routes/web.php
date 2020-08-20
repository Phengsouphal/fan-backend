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

//Teacher Routes
Route::get('/teacher', 'TeacherController@index')->name('teacher');
Route::get('/teacher/add', 'TeacherController@create')->name('add.teacher');
Route::get('/teacher/store', 'TeacherController@store')->name('store.teacher');
Route::get('/teacher/edit', 'TeacherController@edit')->name('edit.teacher');
Route::get('/teacher/update', 'TeacherController@update')->name('update.teacher');
Route::get('/teacher/show', 'TeacherController@show')->name('show.teacher');

//Student Routes
Route::get('/student', 'StudentController@index')->name('student');
Route::get('/student/add', 'StudentController@create')->name('add.student');
Route::get('/student/store', 'StudentController@store')->name('store.student');
Route::get('/student/edit{id}', 'StudentController@edit')->name('edit.student');
Route::put('/student/update{id}', 'StudentController@update')->name('update.student');
Route::get('/student/show{id}', 'StudentController@show')->name('show.student');
Route::delete('/student/destroy{id}', 'StudentController@destroy')->name('destroy.student');

//Class Routes
Route::get('/class', 'ClassController@index')->name('class');
Route::get('/class/add', 'ClassController@create')->name('add.class');
Route::get('/class/store', 'ClassController@store')->name('store.class');
Route::get('/class/edit', 'ClassController@edit')->name('edit.class');
Route::get('/class/update', 'ClassController@update')->name('update.class');
Route::get('/class/show', 'ClassController@show')->name('show.class');

//Level Routes
Route::get('/level', 'LevelController@index')->name('level');
Route::get('/level/add', 'LevelController@create')->name('add.level');
Route::get('/level/store', 'LevelController@store')->name('store.level');
Route::get('/level/edit', 'LevelController@edit')->name('edit.level');
Route::get('/level/update', 'LevelController@update')->name('update.level');
Route::get('/level/show', 'LevelController@show')->name('show.level');

//Job Opportunity Routes
Route::get('/job_opportunity', 'JobOpportunityController@index')->name('job_opportunity');
Route::get('/job_opportunity/add', 'JobOpportunityController@create')->name('add.job_opportunity');
Route::get('/job_opportunity/store', 'JobOpportunityController@store')->name('store.job_opportunity');
Route::get('/job_opportunity/edit', 'JobOpportunityController@edit')->name('edit.job_opportunity');
Route::get('/job_opportunity/update', 'JobOpportunityController@update')->name('update.job_opportunity');
Route::get('/job_opportunity/show', 'JobOpportunityController@show')->name('show.job_opportunity');
