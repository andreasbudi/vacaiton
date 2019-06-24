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

        <table class="table table-hover table-sm">
            <tr>
                <th width="50px"><b>No.</b></th>
                <th>From</th>
                <th>To</th>
                <th>Duration (Days)</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach ($leaves as $leave)
                <tr>
                    <td><b>{{++$i}}.</b></td>
                    <td>{{$leave->from}}</td>
                    <td>{{$leave->to}}</td>
                    <td>{{$leave->duration}}</td>
                    <td>{{$leave->reason}}</td>
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