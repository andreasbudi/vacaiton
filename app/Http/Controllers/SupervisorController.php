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

        $supervisors = DB::table('supervisors')
                ->select(['supervisors.id','supervisors.name_supervisor']);
                return Datatables::of($supervisors)
        ->addColumn('action', function ($supervisors) {
            return 
            '<form class="delete-form" action="'.route('supervisor.destroy', $supervisors->id).'" method="post">
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                <input type="hidden" name="_token" value="'.csrf_token().'">
                <input type="hidden" name="_method" value="delete" />
            </form>';
        })
        ->make(true);
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
            "positionClass"     => "toast-top-center",
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
            "positionClass"     => "toast-top-center",
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
