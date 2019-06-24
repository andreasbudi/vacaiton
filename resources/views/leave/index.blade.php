@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3>My Leaves History</h3>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-sm btn-success" href="{{ route('leave.create')}}">Apply Leaves</a>
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
                <th style="text-align:center;">From</th>
                <th style="text-align:center;">To</th>
                <th style="text-align:center;">Duration (Days)</th>
                <th style="text-align:center;">Reason</th>
                <th style="text-align:center;">Status</th>
                <th style="text-align:center;">Action</th>
            </tr>

            @foreach ($leaves as $leave)
                <tr>
                    <td style="text-align:center;"><b>{{++$i}}.</b></td>
                    <td style="text-align:center;">{{$leave->from}}</td>
                    <td style="text-align:center;">{{$leave->to}}</td>
                    <td style="text-align:center;">{{$leave->duration}}</td>
                    <td style="text-align:center;">{{$leave->reason}}</td>
                    <th>
                            @if($leave->status == true)
                                <span class="label label-info">Approved</span>
                            @else
                                <span class="label label-danger">Waiting to be Approve</span>
                            @endif
    
                        </th>
                    <td>
                        <form action="{{ route('leave.destroy', $leave->id)}}" method="post">
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