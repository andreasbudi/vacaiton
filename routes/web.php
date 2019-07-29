<?php

use App\Leave;
use App\User;
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
        if(Auth::user()->role_id == '1'){
            return view('leave.index');
        }
        if(Auth::user()->role_id == '2'){
            $leaves = Leave::where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1)->get();
            return view('approval.approval', compact('leaves'));
        }
        if(Auth::user()->role_id == '3'){
            $leaves = Leave::with('users')
            ->where('status',2)->take(5)
            ->orderBy('updated_at', 'desc')
            ->get();
            return view('approval.approval', compact('leaves'));
        }
        if(Auth::user()->role_id == '4'){
            $employees = User::all()->where('users.role_id',1)->where('supervisors.id', '=', 'users.manager_id')->first();
            return view('employee.show', compact('employees')); 
        }}
    else{
            return view('auth/login');
        } 
});

Route::get('/login', function () {
    return view('auth/login');
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
Route::get('supervisor/json', 'SupervisorController@json');
Route::get('leave/jsonTeamSpv', 'LeaveController@jsonTeamSpv');
Route::get('employee/create', 'EmployeeController@create');
Route::get('employee/{id}', 'EmployeeController@destroy');


Auth::routes();

Route::resource('leave','LeaveController');
Route::resource('employee','EmployeeController');
Route::resource('approval','ApprovalController');
Route::resource('supervisor', 'SupervisorController');
