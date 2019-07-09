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
    if(Auth::user()){
        if(Auth::user()->role_id == '1' && Auth::user()->role_id == '2'){
            return view('welcome');
        }
        if(Auth::user()->role_id == '3'){
            return view('welcome');
        }
        else{
            return view('welcome');     
        }}
    else{
            return view('auth/login');
        } 
});

Route::get('/login', function () {
    return view('auth/login');
});


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/profile', 'EmployeeController@profile')->name('employee.profile');
Route::get('/show', 'EmployeeController@show');
Route::get('/showsupervisor', 'SupervisorController@show');
Route::get('/logout','HomeController@logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('leave/send', 'LeaveController@send');
Route::get('home/json', 'ApprovalController@json');
Route::get('show/json', 'EmployeeController@json');
Route::get('leave/json', 'LeaveController@json');
Route::get('leave/jsonTeamSpv', 'LeaveController@jsonTeamSpv');

Auth::routes();

Route::resource('leave','LeaveController');
Route::resource('employee','EmployeeController');
Route::resource('approval','ApprovalController');
Route::resource('role', 'RoleController');
Route::resource('supervisor', 'SupervisorController');
