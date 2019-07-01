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

class EmployeeController extends Controller
{
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

        $users = User::all();
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
        $employees = User::latest()->paginate(10);
        return view('employee.show', compact('employees'))
                    ->with('i',(request()->input('page',1) -1) *5); 
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
        return view('employee.update', compact('employee'));
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
        $request->validate([
            'department' => 'required',
            'email' => 'required',
            'leaves_available' => 'required',
            'role_id' => 'required',
            'manager_id' => 'required'
        ]);
        $employee = User::find($id);
        $employee->department = $request->get('department');
        $employee->email = $request->get('email');
        $employee->leaves_availabe = $request->get('leaves_available');
        $employee->role_id = $request->get('role_id');
        $employee->manager_id = $request->get('manager_id');
        $employee->save();
        return redirect()->route('home')
                        ->with('success', 'Employee updated successfully');
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
        $employee->delete();
        return redirect()->route('home')
                        ->with('success','Employee have been delete');
    }

}
