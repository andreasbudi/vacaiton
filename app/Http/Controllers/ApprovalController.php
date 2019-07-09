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
                ->select(['leaves.id','users.name','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status'])
                ->where('leaves.status', '=', 1);
        return Datatables::of($approval)
        ->addColumn('action', function ($approval) {
            if($approval->status == 1){
            return '<a class="btn btn-sm btn-success" value="send" style="margin-left:18%;" href="'.route('approval.show',$approval->id).'">Approve</a>
            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#m_modal_4">Reject</button>

            <div class="modal fade" id="m_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
									<div class="modal-body">
										<form>
											<div class="form-group">
												<label for="recipient-name" class="form-control-label">
													Rejection message ?
												</label>
												<input type="text" class="form-control" id="recipient-name">
											</div>
										</form>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
											Close
										</button>
                                        <form>
                                        <a class="btn btn-sm btn-danger" value="send" href="'.route('approval.edit',$approval->id).'">Reject</a>
                                        </form>
									</div>
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
                ->select(['leaves.id','users.name','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status','leaves.manager_id','leaves.role_id'])
                ->where('leaves.manager_id', Auth::user()->manager_id)
                ->where('leaves.role_id',1)
                ->where('leaves.status', '=', 1);
        return Datatables::of($approval)
        ->addColumn('action', function ($approval) {
            if($approval->status == 1){
            return '<form><a class="btn btn-sm btn-success" value="send" style="margin-left:18%;" href="'.route('approval.show',$approval->id).'">Approve</a>
            <a class="btn btn-sm btn-danger" value="send" href="'.route('approval.edit',$approval->id).'">Reject</a></form>';
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
            return view('approval.approval');
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
