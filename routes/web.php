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
    return view('auth/login');
});

Route::get('/login', function () {
    return view('auth/login');
});


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('employee/profile');
});

Route::get('/logout','HomeController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('leave','LeaveController');
Route::resource('employee','EmployeeController');
Route::post('leave/send', 'LeaveController@send');