@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3>My Leaves History</h3>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif

    
        <table class="table table-hover table-sm" >
            <tr>
                <th width="50px"style="text-align:center;"><b>No.</b></th>
                <th style="text-align:center;width:200px;">From</th>
                <th style="text-align:center;width:200px;">To</th>
                <th style="text-align:center;width:200px;">Duration</th>
                <th style="text-align:center; width:100px;">Reason</th>
                <th style="text-align:center; width:300px;">Status</th>
                <th style="text-align:center;"></th>
            </tr>

            @foreach ($leaves as $leave)
                <tr>
                    <td style="text-align:center;"><b>{{++$i}}.</b></td>
                    <td style="text-align:center;">{{$leave->from}}</td>
                    <td style="text-align:center;">{{$leave->to}}</td>
                    <td style="text-align:center;">{{$leave->duration}} days</td>
                    <td style="text-align:center;">{{$leave->reason}}</td>
                    <th>
                            @if($leave->status == 1)
                            <center><span class="label label-info">Waiting for Approval</span></center>
                            @elseif($leave->status == 2)
                            <center><span class="label label-danger">Approved</span></center>
                            @elseif($leave->status == 3)
                            <center><span class="label label-danger">Rejected</span></center>
                            @endif
    
                        </th>
                    <td>
                        <form action="{{ route('leave.destroy', $leave->id)}}" method="post" style="width:180px;">
                            <a class="btn btn-sm btn-success" href="{{route('leave.show',$leave->id)}}">Show</a>
                            <a class="btn btn-sm btn-warning" href="{{route('leave.edit',$leave->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        
                        </form>
                    </td>
                </tr>
                
            @endforeach

        </table>

{!! $leaves->links() !!}
    </div>
@endsection