<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMailClient;
use App\Mail\SendMailSpv;
use App\Leave;
use App\User;
use Carbon\Carbon;
class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::where('user_id', '=', Auth::user()->id)->paginate(5);

        return view('leave.index', compact('leaves'))
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
        return view('leave.detail', compact('leave'));
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
