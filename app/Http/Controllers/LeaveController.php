<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Leave;
class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::latest()->paginate(5);
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

        $data = array(
            'from' => $request->from,
            'to' => $request->to,
            'duration' => $request->duration,
            'reason' => $request->reason,
            'status' => $request->status
        );

        Mail::to('andreas.b365@gmail.com')->send(new SendMail($data));

        Leave::create($request->all());
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
}
