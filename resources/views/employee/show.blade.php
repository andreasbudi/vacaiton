@extends('layouts.app')
@section('content')
    <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Hi, {{(Auth::user()->name)}}<br>
                                This is List Member of Difinite 
                            </h3>
                        </div>
                    </div>
                </div>
    
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
                @endif
    
                
                    <!--begin: Datatable -->
                    <div class="m_datatable" id="ajax_data">
                        <table class="table table-hover table-sm" >
                                <tr>
                                        <th width="150px"style="text-align:center;"><b>No.</b></th>
                                        <th style="text-align:center;width:200px;">Name</th>
                                        <th style="text-align:center;width:200px;">Department</th>
                                        <th style="text-align:center;width:200px;">Email</th>
                                        <th style="text-align:center; width:300px;">Leaves Available</th>
                                        <th style="text-align:center; width:300px;">Role</th>
                                        <th style="text-align:center; width:300px;">Supervisor</th>
                                        <th></th>
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
                                                <form action="{{ route('employee.destroy', $employee->id)}}" method="post" style="width:180px;">
                                                    <a class="btn btn-sm btn-warning" href="{{route('employee.edit',$employee->id)}}">Edit</a> 
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                
                        </table>
                    </div>
                    <!--end: Datatable -->
                
            </div>
        </div>
@endsection