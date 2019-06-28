@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h3>Employees Management</h3>
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
                <th style="text-align:center;width:200px;">Department</th>
                <th style="text-align:center;width:200px;">Email</th>
                <th style="text-align:center; width:300px;">Leaves Available</th>
                <th style="text-align:center; width:300px;">Role</th>
                <th style="text-align:center; width:300px;">Supervisor</th>
            </tr>

            @foreach ($employees as $employee)
                <tr>
                    <td style="text-align:center;"><b>{{++$i}}.</b></td>
                    <td style="text-align:center;">{{$employee->name}}</td>
                    <td style="text-align:center;">{{$employee->department}}</td>
                    <td style="text-align:center;">{{$employee->email}}</td>
                    <td style="text-align:center;">{{$employee->leaves_available}}</td>
                    <td style="text-align:center;">{{$employee->roles->name_role}}</td>
                    <td style="text-align:center;">{{@$employee->supervisors->name_supervisor}}</td>
                    <td>
                        {{-- <form action="{{ route('leave.destroy', $leave->id)}}" method="post" style="width:180px;">
                            <a class="btn btn-sm btn-success" href="{{route('leave.show',$leave->id)}}">Show</a>
                            <a class="btn btn-sm btn-warning" href="{{route('leave.edit',$leave->id)}}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        
                        </form> --}}
                    </td>
                </tr>
                
            @endforeach

        </table>

    </div>
@endsection