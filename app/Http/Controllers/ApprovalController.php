<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendApprove;
use App\Mail\SendReject;
use DB;
use App\Leave;
use App\User;
use DataTables;

class ApprovalController extends Controller
{
    public function json(){
        // manager query all leaves
        if(empty(Auth::user()->manager_id)){
        $approval = DB::table('leaves')->join('users', 'leaves.user_id', '=', 'users.id')
                ->select(['leaves.id','users.name','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status','leaves.updated_at'])
                ->where('leaves.status', '=', 1)
                ->orderBy('leaves.updated_at');
        return Datatables::of($approval)->addIndexColumn()
        ->addColumn('action', function ($approval) {
            if($approval->status == 1){
            return '<a class="btn btn-sm btn-success" style="float:left; width:45%;" href="'.route('approval.show',$approval->id).'">Approve</a>
            <button type="button" class="btn btn-sm btn-danger" style="float:right; width:45%;" data-toggle="modal" data-target="#m_modal_4_'.$approval->id.'">Reject</button>
            <div class="modal fade" id="m_modal_4_'.$approval->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    &times;
                                </span>
                            </button>
                        </div>
                        <form action="'.route('approval.edit',$approval->id).'" method="get">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        Rejection message ?
                                    </label>
                                    <input type="text" class="form-control" name="reject_message" id="reject_message">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="color:black;">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </div>
                        </form>
                    </div>
                </div>
			</div>';
            }elseif($approval->status == 2){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>';
            }elseif($approval->status == 3){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>';
            }elseif($approval->status == 4){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Canceled</span></center>';
            }})->make(true);
        }else{
        $approval = DB::table('leaves')->join('users', 'leaves.user_id', '=', 'users.id')
                ->select(['leaves.id','users.name','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status','leaves.manager_id','leaves.role_id','leaves.updated_at'])
                ->where('leaves.manager_id', Auth::user()->manager_id)
                ->where('leaves.role_id',1)
                ->where('leaves.status', '=', 1)
                ->orderBy('leaves.updated_at');
        return Datatables::of($approval)->addIndexColumn()
        ->addColumn('action', function ($approval) {
            if($approval->status == 1){
            return '<a class="btn btn-sm btn-success" value="send" style="float:left; width:45%;" href="'.route('approval.show',$approval->id).'">Approve</a>
            <button type="button" class="btn btn-sm btn-danger" style="float:right; width:45%;" data-toggle="modal" data-target="#m_modal_4_'.$approval->id.'">Reject</button>
            <div class="modal fade" id="m_modal_4_'.$approval->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    &times;
                                </span>
                            </button>
                        </div>
                        <form action="'.route('approval.edit',$approval->id).'" method="get">
                        <div class="modal-body">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        Rejection message ?
                                    </label>
                                    <input type="text" class="form-control" name="reject_message" id="reject_message">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="color:black;">Close</button>
                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                        </div>
                        </form>
                    </div>
                </div>
			</div>';
            }elseif($approval->status == 2){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>';
            }elseif($approval->status == 3){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>';
            }elseif($approval->status == 4){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Canceled</span></center>';
            }})->make(true);
            }
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $leaves = Leave::with('users')
        ->where('status',2)->take(5)
        ->orderBy('updated_at', 'desc')
        ->get();
        return view('approval.approval', compact('leaves'));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //diapproved
        $leave = Leave::find($id);
        $leave->status = 2;
        $leave->responded_by = Auth::user()->name;
        $leave->save();

        $user_email = $leave->users->email;
        $user_name = $leave->users->name;
        $spv_name = Auth::user()->name;
        $spv_department = Auth::user()->department;

        $data = array(
            'name' => $user_name,
            'nameSpv' => $spv_name,
            'spv_department' => $spv_department,
            'email' => $user_email,
            'from' => \Carbon\Carbon::parse($leave->from)->format('d F Y'),
            'to' => \Carbon\Carbon::parse($leave->to)->format('d F Y')
        );

        if($leave->status == 2){
            //  Mail::to($user_email)->send(new SendApprove($data));
            toastr()->success('Leave approved successfully','', [ 
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
            return redirect()->route('approval.index');

        }else{
            toastr()->error('Approve failed. Please try again','', [ 
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
            return redirect()->route('approval.index');
        }   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        //direject
        $leave = Leave::find($id);
        $leave->reject_message = $request->get('reject_message');
        $leave->status = 3;
        $leave->responded_by = Auth::user()->name;
        $leave->save();

        $user_email = $leave->users->email;
        $user_name = $leave->users->name;
        $spv_name = Auth::user()->name;
        $spv_department = Auth::user()->department;

        $data = array(
            'name' => $user_name,
            'nameSpv' => $spv_name,
            'spv_department' => $spv_department,
            'from' => \Carbon\Carbon::parse($leave->from)->format('d F Y'),
            'to' => \Carbon\Carbon::parse($leave->to)->format('d F Y'),
            'reason' => $leave->reason,
            'reject_message' => $leave->reject_message,
        );

        if($leave->status == 3){
            // Mail::to($user_email)->send(new SendReject($data));
            toastr()->success('Leave rejected successfully','', [ 
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
            return redirect()->route('approval.index');

        }else{
            toastr()->error('Approve failed. Please try again','', [ 
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
            return redirect()->route('approval.index');
        }   
    }
}
