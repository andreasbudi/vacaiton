<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
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
                ->select(['users.id','users.name','users.department','users.email','users.leaves_available','roles.name_role','supervisors.name_supervisor']);
        return Datatables::of($employees)
        ->addColumn('action', function ($employees) {
            return '<form action="'.route('employee.destroy', $employees->id).'" method="post"><a class="btn btn-sm btn-warning" href="'.route('employee.edit',$employees->id).'">Edit</a>
            <a class="btn btn-sm btn-danger" href="'.route('employee.destroy',$employees->id).'">Delete</a></form>';
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
        $employeeData['role_id'] = $request->role_id;
        $employeeData['manager_id'] = $request->manager_id;
        $employeeData->save();

        return redirect()->route('home')
                        ->with('success','Employee have been added');
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
            return redirect()->route('home')
                        ->with('success', 'Employee updated successfully');
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
            return redirect()->route('home')
                        ->with('success', 'Employee updated successfully');
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
            return redirect()->route('home')
                        ->with('success', 'Employee updated successfully');
        }
        else{
            $employee = User::find($id);
            $employee->password = Hash::make($request->password);
            $employee->save();
            return redirect()->route('home')
                        ->with('success', 'Employee update successfully');
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
        csrf_field;
        method('DELETE');
        $employee->delete();
        return redirect()->route('home')
                        ->with('success','Employee have been deleted');
    }

}
