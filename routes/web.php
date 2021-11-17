<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/subjects/registration', 'SubjectController@registration')->name('subjects.registration');
Route::get('/subjects/registration/{subject}', 'SubjectController@registrationDetail')->name('subjects.registration.detail');
Route::put('/subjects/registration/{subject}', 'SubjectController@registrationSubmit')->name('subjects.registration.submit');
Route::resource('subjects', SubjectController::class)->except(['destroy']);
Route::resource('users', UserController::class)->except(['index']);
Route::get('/users/view/{role}', 'UserController@index')->name('users.index');
Route::get('/users/toggle/{user}', 'UserController@toggle')->name('users.toggle');
