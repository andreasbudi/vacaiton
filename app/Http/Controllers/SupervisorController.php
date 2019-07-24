<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersRoles;
use App\User;
use App\Supervisor;
use App\Role;
use DB;
use DataTables;

class SupervisorController extends Controller
{
    public function json(){

        //query isi tim supervisor

        $supervisors = DB::table('supervisors')->leftjoin('users','supervisors.id','=','users.manager_id')
                ->select(['supervisors.id','supervisors.name_supervisor',DB::raw('GROUP_CONCAT(users.name SEPARATOR " - ") as name'),'users.manager_id','users.role_id'])
                ->where('users.role_id',1)
                ->orWhere('users.role_id',null)
                ->groupBy('supervisors.name_supervisor');
                return Datatables::of($supervisors)->make(true);
    }


      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisor.newsupervisor');
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
            'name_supervisor' => 'required',
        ]);

        $roleData = new Supervisor();
        $roleData->name_supervisor = $request->name_supervisor;
        $roleData->save();
        toastr()->success('Supervisor added successfully','', [ 
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
        $supervisors = User::with('supervisors')
        ->where('role_id',1)
        // ->where('users.manager_id','=','supervisors.id')
        ->get();
        return view('supervisor.showsupervisor', compact('supervisors')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supervisor = Supervisor::find($id);
        $supervisor->delete();
        toastr()->success('Supervisor deleted successfully','', [ 
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
        return redirect()->route('showsupervisor');
    }

}
