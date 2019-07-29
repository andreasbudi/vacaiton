<?php

namespace App\Http\Controllers;
use App\Leave;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $getRole = Auth::user()->role_id;

        if($getRole == 1){
            return view('leave.index'); 
        }
        else if($getRole == 2){
            $leaves = Leave::where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1)->get();
            return view('approval.approval', compact('leaves'));
        }
        else if($getRole == 3){
            $leaves = Leave::with('users')
            ->where('status',2)->take(5)
            ->orderBy('updated_at', 'desc')
            ->get();
            return view('approval.approval', compact('leaves'));
        }
        else if($getRole == 4){
            $employees = User::all()->where('users.role_id',1)->where('supervisors.id', '=', 'users.manager_id')->first();
            return view('employee.show', compact('employees')); 
        }    
    }

    public function logout()
    {
        return view('auth/login');
    }
    


}
