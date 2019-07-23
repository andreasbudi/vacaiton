<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Mail\SendAddEmployee;
use App\User;
use App\Supervisor;
use App\Role;
use App\Leave;
use DB;
use DataTables;

class EmployeeController extends Controller
{
    public function json(){

        // spv query leave history dia sendiri
        $employees = DB::table('users')->leftjoin('roles', 'users.role_id', '=', 'roles.id')->leftjoin('supervisors', 'users.manager_id', '=', 'supervisors.id')
                ->select(['users.id','users.name','users.department','users.email','users.leaves_available','roles.name_role','supervisors.name_supervisor','users.isActivated'])
                ->where('users.role_id','!=',4);
                return Datatables::of($employees)->addIndexColumn()
        ->addColumn('action', function ($employees) {
            return '<a  style="width:45%;" class="btn btn-sm btn-warning" href="'.route('employee.edit',$employees->id).'">Edit</a>';
        })->make(true);
    }

        
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::all();
        $managers = Supervisor::all();

        return view('employee.add',compact('roles','managers'));
    }
      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $users = User::all()->where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1);
        $roles = Role::all();
        return view('employee.profile',compact('users','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $employeeData = new User();
        $employeeData->name = $request->name;
        $employeeData->department = $request->department;
        $employeeData->email = $request->email;
        $employeeData->password = Hash::make($request->password);
        $employeeData->leaves_available = $request->leaves_available;
        $employeeData->isActivated = '1';
        $employeeData['role_id'] = $request->role_id;
        $employeeData['manager_id'] = $request->manager_id;
        $employeeData->save();

        $data = array(
            'name'              => $request->name,
            'email'             => $request->email,
            'password'          => $request->password,
            'department'        => $request->department,
            'leaves_available'  => $request->leaves_available,
        );

        // Mail::to($request->email)->send(new SendAddEmployee($data));

        toastr()->success('Employee added successfully','', [ 
            "closeButton"       => true,
            "debug"             => false,
            "newestOnTop"       => false,
            "progressBar"       => false,
            "positionClass"     => "toast-top-right",
            "preventDuplicates" => false,
            "onclick"           => null,
            "showDuration"      => "300",
            "hideDuration"      => "1000",
            "timeOut"           => "3000",
            "extendedTimeOut"   => "1000",
            "showEasing"        => "swing",
            "hideEasing"        => "linear",
            "showMethod"        => "slideDown",
            "hideMethod"        => "slideUp"]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('employee.show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
        $employee = User::find($id);
        
        $users = User::all()->where('manager_id', '=', Auth::user()->manager_id)
        ->where('role_id',1);
        $roles = Role::all();
        $managers = Supervisor::all();
        return view('employee.update', compact('employee','roles','managers','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = User::find($id);

        if(Auth::user()->role_id == '4' && $employee->role_id == 1){
        $request->validate([
            'department' => 'required',
            'role_id' => 'required',
            'manager_id' => 'required',
        ]);
            $employee->name = $request->get('name');
            $employee->department = $request->get('department');
            $employee->email = $request->get('email');
            $employee->leaves_available = $request->get('leaves_available');
            $employee['role_id'] = $request->get('role_id');
            $employee['manager_id'] = $request->get('manager_id');
            $employee->save();
            toastr()->success('Employee updated successfully','', [ 
                "closeButton"       => true,
                "debug"             => false,
                "newestOnTop"       => false,
                "progressBar"       => false,
                "positionClass"     => "toast-top-right",
                "preventDuplicates" => false,
                "onclick"           => null,
                "showDuration"      => "300",
                "hideDuration"      => "1000",
                "timeOut"           => "3000",
                "extendedTimeOut"   => "1000",
                "showEasing"        => "swing",
                "hideEasing"        => "linear",
                "showMethod"        => "slideDown",
                "hideMethod"        => "slideUp"]);
            return redirect()->route('home');
        }
        
        elseif (Auth::user()->role_id == '4' && $employee->role_id == 2){
        $request->validate([
            'department' => 'required',
            'role_id' => 'required'
        ]);
            $employee->name = $request->get('name');
            $employee->department = $request->get('department');
            $employee->email = $request->get('email');
            $employee->leaves_available = $request->get('leaves_available');
            $employee['role_id'] = $request->get('role_id');
            $employee->save();
            toastr()->success('Employee updated successfully','', [ 
                "closeButton"       => true,
                "debug"             => false,
                "newestOnTop"       => false,
                "progressBar"       => false,
                "positionClass"     => "toast-top-right",
                "preventDuplicates" => false,
                "onclick"           => null,
                "showDuration"      => "300",
                "hideDuration"      => "1000",
                "timeOut"           => "3000",
                "extendedTimeOut"   => "1000",
                "showEasing"        => "swing",
                "hideEasing"        => "linear",
                "showMethod"        => "slideDown",
                "hideMethod"        => "slideUp"]);
            return redirect()->route('home');
        }
        elseif (Auth::user()->role_id == '4' && $employee->role_id == 3){
        $request->validate([
            'department' => 'required',
            'role_id' => 'required'
        ]);
            $employee->name = $request->get('name');
            $employee->department = $request->get('department');
            $employee->email = $request->get('email');
            $employee['role_id'] = $request->get('role_id');
            $employee->save();
            toastr()->success('Employee updated successfully','', [ 
                "closeButton"       => true,
                "debug"             => false,
                "newestOnTop"       => false,
                "progressBar"       => false,
                "positionClass"     => "toast-top-right",
                "preventDuplicates" => false,
                "onclick"           => null,
                "showDuration"      => "300",
                "hideDuration"      => "1000",
                "timeOut"           => "3000",
                "extendedTimeOut"   => "1000",
                "showEasing"        => "swing",
                "hideEasing"        => "linear",
                "showMethod"        => "slideDown",
                "hideMethod"        => "slideUp"]);
            return redirect()->route('home');
        }
        else{
            $employee = User::find($id);
            $employee->password = Hash::make($request->password);
            $employee->save();
            toastr()->success('Password updated successfully','', [ 
                "closeButton"       => true,
                "debug"             => false,
                "newestOnTop"       => false,
                "progressBar"       => false,
                "positionClass"     => "toast-top-right",
                "preventDuplicates" => false,
                "onclick"           => null,
                "showDuration"      => "300",
                "hideDuration"      => "1000",
                "timeOut"           => "3000",
                "extendedTimeOut"   => "1000",
                "showEasing"        => "swing",
                "hideEasing"        => "linear",
                "showMethod"        => "slideDown",
                "hideMethod"        => "slideUp"]);
            return redirect()->route('home');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = User::find($id);
        $employee->isActivated = '0';
        $employee->save();
        toastr()->success('Employee deactivated successfully','', [ 
        "closeButton"       => true,
        "debug"             => false,
        "newestOnTop"       => false,
        "progressBar"       => false,
        "positionClass"     => "toast-top-right",
        "preventDuplicates" => false,
        "onclick"           => null,
        "showDuration"      => "300",
        "hideDuration"      => "1000",
        "timeOut"           => "3000",
        "extendedTimeOut"   => "1000",
        "showEasing"        => "swing",
        "hideEasing"        => "linear",
        "showMethod"        => "slideDown",
        "hideMethod"        => "slideUp"]);

        return redirect()->route('home');
    }

}
