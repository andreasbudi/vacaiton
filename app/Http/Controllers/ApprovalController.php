<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Leave;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::latest()->paginate(5);
        return view('approval.approval', compact('leaves'))
                    ->with('i',(request()->input('page',1) -1) *5);
    }
}