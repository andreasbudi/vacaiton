<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;
use App\Leave;
use App\User;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //masuk sebagai spv bisa liat approval
        if(Auth::user()->manager_id == 1){
            $getStaffs = Leave::where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1)->paginate(5);
            return view('approval.approval', compact('getStaffs'))
            ->with('i',(request()->input('page',1) -1) *5);

        }elseif(Auth::user()->manager_id == 2){
            $getStaffs = Leave::where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1)->paginate(5);
            return view('approval.approval', compact('getStaffs'))
            ->with('i',(request()->input('page',1) -1) *5);
        }elseif(Auth::user()->manager_id == 3){
            $getStaffs = Leave::where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1)->paginate(5);
            return view('approval.approval', compact('getStaffs'))
            ->with('i',(request()->input('page',1) -1) *5);
        }elseif(empty(Auth::user()->manager_id)){
            $getStaffs = Leave::latest()->paginate(5);
            return view('approval.approval', compact('getStaffs'))
            ->with('i',(request()->input('page',1) -1) *5);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leave = Leave::find($id);
        return view('approval.approvalacc', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leave = Leave::find($id);
        return view('approval.approvalrej', compact('leave'));
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
            'status' => 'required'
        ]);

        $leave = Leave::find($id);
        $leave->status = $request->get('status');

        if($leave->save()){
            return redirect()->route('approval.index')
                        ->with('success', 'Leave Approved');

        }else{
            return redirect()->route('approval.index')
                        ->with('error', 'Failed approve. Please try again');
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
        //
    }

}
