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
        $leaves = Leave::where('user_id', '=', Auth::user()->id)->paginate(5);

        if($getRole == 1){
        return view('leave.index', compact('leaves'))
                    ->with('i',(request()->input('page',1) -1) *5); 
        }
        else if($getRole == 2){
        $getStaffs = Leave::latest()->paginate(5);
        return view('approval.approval', compact('getStaffs'))
                    ->with('i',(request()->input('page',1) -1) *5);
        }
        else if($getRole == 3){
        $getStaffs = Leave::latest()->paginate(5);
        return view('approval.approval', compact('getStaffs'))
                    ->with('i',(request()->input('page',1) -1) *5);
        }
        else if($getRole == 4){
        $employees = User::latest()->paginate(10);
        return view('employee.show', compact('employees'))
                    ->with('i',(request()->input('page',1) -1) *5); 
        }    
    }

    public function logout()
    {
        return view('auth/login');
    }
    


}
