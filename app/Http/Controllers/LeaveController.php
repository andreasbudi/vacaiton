<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMailClient;
use App\Mail\SendMailSpv;
use App\Mail\SendCancel;
use App\Leave;
use App\User;
use App\Supervisor;
use DB;
use DataTables;

class LeaveController extends Controller
{
        public function json(){
        //query leave history sendiri
        $leaves = DB::table('leaves')->join('users', 'leaves.user_id', '=', 'users.id')
                ->select(['leaves.id','users.name','leaves.leave_type','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status','leaves.reject_message','leaves.responded_by','leaves.updated_at'])
                ->where('user_id', '=', Auth::user()->id)
                ->orderBy('leaves.updated_at');
        return Datatables::of($leaves)->addIndexColumn()
        ->addColumn('action', function ($leaves) {
            if($leaves->status == 1){
            return '<a class="btn btn-sm btn-warning" style="width:40%;" href="'.route('leave.edit',$leaves->id).'">Edit</a>
            
                    <a class="btn btn-sm btn-danger" style="width:40%;" href="'.route('leave.show',$leaves->id).'" data-toggle="modal" data-target="#m_modal_5_'.$leaves->id.'">Cancel</a>

            <div class="modal fade" id="m_modal_5_'.$leaves->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			    <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
						<div class="modal-body">
                            <div class="form-group">
                                <br>
                                    <label class="form-control-label">
                                        Are you sure ?
                                    </label>
                                <br>
                                <br>
                                    <button type="button" class="btn btn-sm btn-secondary" style="color:black;" data-dismiss="modal">Close</button>
                                    <a href="'.route('leave.show',$leaves->id).'" class="btn btn-sm btn-danger">Cancel</a>
                            </div>
						</div>
					</div>
				</div>
            </div>';
            }elseif($leaves->status == 2){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>';
            }elseif($leaves->status == 3){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>';
            }elseif($leaves->status == 4){
            return '<center><span class="m-badge m-badge--default m-badge--wide">Canceled</span></center>';
            }})->make(true);        
        }

        public function jsonTeamSpv(){
        // spv query team leaves
        $leaves = DB::table('leaves')->join('users', 'leaves.user_id', '=', 'users.id')
                ->select(['leaves.id','users.name','leaves.leave_type','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status','leaves.manager_id','leaves.role_id','leaves.reject_message','leaves.responded_by','leaves.updated_at'])
                ->where('leaves.manager_id', Auth::user()->manager_id)
                ->where('leaves.role_id',1)
                ->orderBy('leaves.updated_at');
        return Datatables::of($leaves)->addIndexColumn()
        ->addColumn('action', function ($leaves) {
            if($leaves->status == 1){
            return '<center><span class="m-badge m-badge--warning m-badge--wide">Submitted</span></center>';
            }elseif($leaves->status == 2){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>';
            }elseif($leaves->status == 3){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>';
            }elseif($leaves->status == 4){
            return '<center><span class="m-badge m-badge--default m-badge--wide">Canceled</span></center>';
            }})->make(true);  
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::where('user_id', '=', Auth::user()->id)->paginate(5);
        $team_leaves = Leave::where('manager_id', '=', Auth::user()->manager_id)
                            ->where('role_id',1)
                            ->where('status', '!=', 1)->paginate(5);


        return view('leave.index', compact('leaves','team_leaves'))
                    ->with('i',(request()->input('page',1) -1) *5); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$leaves = Leave::where('user_id', '=', Auth::user()->id);
        $leaves = Leave::with('users')->where('status',2)->get();
        return view('leave.create', compact('leaves'));
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
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required'
        ]);

        

        $leaveData = new Leave();
        $leaveData->from = \Carbon\Carbon::parse($request->from)->format('y-m-d');
        $leaveData->to = \Carbon\Carbon::parse($request->to)->format('y-m-d');
        $leaveData->duration = $request->duration;
        $leaveData->reason = $request->reason;
        $leaveData->leave_type = $request->leave_type;
        $leaveData['user_id'] = Auth::user()->id;
        $leaveData['role_id'] = Auth::user()->role_id;
        $leaveData['manager_id'] = Auth::user()->manager_id;
        $leaveData->save();

        $user = User::find(Auth::user()->id);
        $user->leaves_available = Auth::user()->leaves_available - $request->duration;
        $user->save();

        $dataClient = array(
            'from' => \Carbon\Carbon::parse($request->from)->format('d F Y'),
            'to' => \Carbon\Carbon::parse($request->to)->format('d F Y'),
            'duration' => $request->duration,
            'leave_type' => $request->leave_type,
            'reason' => $request->reason,
            'leaves_available' => $user->leaves_available,
        );

        //query employee yg mengambil cuti
        $spv = Supervisor::with('users')->where('supervisors.id', '=', Auth::user()->manager_id)->first();
        $username = $spv->name_supervisor;
        $dataSpv = array(
            'name' => Auth::user()->name,
            'nameSpv' => $username
        );

        //query email spv
        $spv = Supervisor::with('users')->where('supervisors.id', '=', Auth::user()->manager_id)->first();
        $spv_email = $spv->email;
        if (Auth::user()->role_id == 1) {
            // Mail::to(Auth::user()->email)->send(new SendMailClient($dataClient));
            // Mail::to($spv_email)->send(new SendMailSpv($dataSpv));
        }

        toastr()->success('New leave created successfully','', [ 
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
        return redirect()->route('leave.index');                   
    }

    /**
     * Cancel the leave Request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $leave = Leave::find($id);
        $leave->status = 4;
        $leave->save();

        $user = User::find(Auth::user()->id);
        $user->leaves_available = Auth::user()->leaves_available + $leave->duration;
        $user->save();

        $spv = Supervisor::with('users')->where('supervisors.id', '=', Auth::user()->manager_id)->first();
        $username = $spv->name_supervisor;
        $dataClient = array(
            'from' => \Carbon\Carbon::parse($user->from)->format('d F Y'),
            'to' => \Carbon\Carbon::parse($user->to)->format('d F Y'),
            'name' => $user->name,
            'nameSpv' => $username,
        );

        // Mail::to($spv->email)->send(new SendCancel($dataClient));

        toastr()->success('Leave canceled successfully','', [ 
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
            return redirect()->route('leave.index');
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
        return view('leave.edit', compact('leave'));
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
        $leave = Leave::find($id);
        $leave_user = $leave->user_id;
        $user = User::find($leave_user);
        $user->leaves_available = $user->leaves_available + $leave->duration;
        $user->save();

        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required'
        ]);
        $leave = Leave::find($id);
        $leave->from = \Carbon\Carbon::parse($request->from)->format('y-m-d');
        $leave->to = \Carbon\Carbon::parse($request->to)->format('y-m-d');
        $leave->duration = $request->get('duration');
        $leave->leave_type = $request->get('leave_type');
        $leave->reason = $request->get('reason');
        $leave->save();

        $user = User::find(Auth::user()->id);
        $user->leaves_available = Auth::user()->leaves_available - $request->duration;
        $user->save();
        toastr()->success('Leave updated successfully','', [ 
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
        return redirect()->route('leave.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leave::find($id);
        $leave->delete();
        return redirect()->route('leave.index')
                        ->with('success','Leave form have been canceled');
    }
}
