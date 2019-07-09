<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMailClient;
use App\Mail\SendMailSpv;
use App\Leave;
use App\User;
use DB;
use DataTables;

class LeaveController extends Controller
{
        public function json(){

        // spv query leave history dia sendiri
        $leaves = DB::table('leaves')->join('users', 'leaves.user_id', '=', 'users.id')
                ->select(['leaves.id','users.name','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status'])
                ->where('user_id', '=', Auth::user()->id);
        return Datatables::of($leaves)
        ->addColumn('action', function ($leaves) {
            if($leaves->status == 1){
            return '<form action="'.route('leave.show', $leaves->id).'" method="post" style="width:180px;"><a class="btn btn-sm btn-warning" href="'.route('leave.edit',$leaves->id).'">Edit</a>
            <a class="btn btn-sm btn-danger" href="'.route('leave.show',$leaves->id).'">Cancel</a></form>';
            }elseif($leaves->status == 2){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>';
            }elseif($leaves->status == 3){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>';
            }elseif($leaves->status == 4){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Canceled</span></center>';
            }})->make(true);        
        }

        public function jsonTeamSpv(){

        // spv query leave history dia sendiri
        $leaves = DB::table('leaves')->join('users', 'leaves.user_id', '=', 'users.id')
                ->select(['leaves.id','users.name','leaves.from','leaves.to','leaves.duration','leaves.reason','leaves.status','leaves.manager_id','leaves.role_id'])
                ->where('leaves.manager_id', Auth::user()->manager_id)
                ->where('leaves.role_id',1);
        return Datatables::of($leaves)
        ->addColumn('action', function ($leaves) {
            if($leaves->status == 1){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Submitted</span></center>';
            }elseif($leaves->status == 2){
            return '<center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>';
            }elseif($leaves->status == 3){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>';
            }elseif($leaves->status == 4){
            return '<center><span class="m-badge m-badge--danger m-badge--wide">Canceled</span></center>';
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
        return view('leave.create');
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

        $dataClient = array(
            'from' => $request->from,
            'to' => $request->to,
            'duration' => $request->duration,
            'reason' => $request->reason,
            'status' => $request->status
        );

        $dataSpv = array(
            'from' => $request->from,
            'to' => $request->to,
            'duration' => $request->duration,
            'reason' => $request->reason,
            'status' => $request->status
        );

        // if (Auth::user()->role_id == 1 && Auth::user()->manager_id == 1) {
        //      $user = 'andika.pranata@difinite.com';
        //         Mail::to(Auth::user()->email)->send(new SendMailClient($dataClient));
        //         Mail::to($user)->send(new SendMailSpv($dataSpv));
        // }elseif (Auth::user()->role_id == 1 && Auth::user()->manager_id == 2) {
        //     $user = 'alexander.arda@difinite.com';
        //        Mail::to(Auth::user()->email)->send(new SendMailClient($dataClient));
        //        Mail::to($user)->send(new SendMailSpv($dataSpv));
        // }elseif (Auth::user()->role_id == 1 && Auth::user()->manager_id == 3) {
        //     $user = 'margaret.pratiwi@difinite.com';
        //        Mail::to(Auth::user()->email)->send(new SendMailClient($dataClient));
        //        Mail::to($user)->send(new SendMailSpv($dataSpv));
        // }

            // if (Auth::user()->role_id == 1 && Auth::user()->manager_id == 1) {
            //     $user = 'andreas.b365@gmail.com';
            //         // Mail::to(Auth::user()->email)->send(new SendMailClient($dataClient));
            //         Mail::to($user)->send(new SendMailSpv($dataSpv));
            // }

        $leaveData = new Leave();
        $leaveData->from = $request->from;
        $leaveData->to = $request->to;
        $leaveData->duration = $request->duration;
        $leaveData->reason = $request->reason;
        $leaveData['user_id'] = Auth::user()->id;
        $leaveData['role_id'] = Auth::user()->role_id;
        $leaveData['manager_id'] = Auth::user()->manager_id;
        $leaveData->save();

        $user = User::find(Auth::user()->id);
        $user->leaves_available = Auth::user()->leaves_available - $request->duration;
        $user->save();
        
        return redirect()->route('leave.index')
                        ->with('success', 'You have submit New Leave Please Wait To Approve');
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
        $leave->status = 4;
        $leave->save();
            return redirect()->route('leave.index')
                        ->with('success', 'Leave Canceled');
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
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'reason' => 'required'
        ]);
        $leave = Leave::find($id);
        $leave->from = $request->get('from');
        $leave->to = $request->get('to');
        $leave->duration = $request->get('duration');
        $leave->reason = $request->get('reason');
        $leave->save();
        return redirect()->route('leave.index')
                        ->with('success', 'Leave form updated successfully');
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

    public function calculateDate()
    {
      //
    }
}
