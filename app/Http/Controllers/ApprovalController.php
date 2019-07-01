<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendApprove;
use App\Mail\SendReject;
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
            $getStaffs = Leave::with('users')->paginate(5);
            return view('approval.approval', compact('getStaffs'))
            ->with('i',(request()->input('page',1) -1) *5);
        }
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
        $leave->status = 2;
        $leave->save();

        $user = $leave->users->email;

        $data = array(
            'from' => $leave->from,
            'to' => $leave->to,
            'duration' => $leave->duration,
            'reason' => $leave->reason,
            'status' => $leave->status
        );

        if($leave->status == 2){
            // Mail::to($user)->send(new SendApprove($data));
            return redirect()->route('approval.index')
                        ->with('success', 'Leave Approved');

        }else{
            return redirect()->route('approval.index')
                        ->with('error', 'Failed approve. Please try again');
        }   
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
        $leave->status = 3;
        $leave->save();

        $user = $leave->users->email;

        $data = array(
            'from' => $leave->from,
            'to' => $leave->to,
            'duration' => $leave->duration,
            'reason' => $leave->reason,
            'status' => $leave->status
        );

        if($leave->status == 3){
            // Mail::to($user)->send(new SendReject($data));
            return redirect()->route('approval.index')
                        ->with('success','Leave Rejected');

        }else{
            return redirect()->route('approval.index')
                        ->with('error', 'Failed approve. Please try again');
        }   
    }
}
