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

Route::get('/profile', 'EmployeeController@profile');
Route::get('/logout','HomeController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('leave/send', 'LeaveController@send');

Auth::routes();

Route::resource('leave','LeaveController');
Route::resource('employee','EmployeeController');
Route::resource('approval','ApprovalController');
