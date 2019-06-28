@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3>Waiting For Approve</h3>
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
                <th style="text-align:center;width:200px;">Name</th>
                <th style="text-align:center;width:200px;">From</th>
                <th style="text-align:center;width:200px;">To</th>
                <th style="text-align:center;width:200px;">Duration</th>
                <th style="text-align:center; width:100px;">Reason</th>
            </tr>

            @foreach ($leaves as $leave)
                <tr>
                    <td style="text-align:center;"><b>{{++$i}}.</b></td>
                    <td style="text-align:center;">{{$leave->user_id}}</td>
                    <td style="text-align:center;">{{$leave->from}}</td>
                    <td style="text-align:center;">{{$leave->to}}</td>
                    <td style="text-align:center;">{{$leave->duration}} days</td>
                    <td style="text-align:center;">{{$leave->reason}}</td>
                    <td>

                        <form style="width:180px;">
                            <a class="btn btn-sm btn-success" value="send" href="{{route('approval.show',$leave->id)}}">Approve</a>
                            <a class="btn btn-sm btn-danger" value="send" href="{{route('approval.edit',$leave->id)}}">Reject</a>
                        </form>
                    </td>
                </tr>
                
            @endforeach

        </table>
    </div>
@endsection