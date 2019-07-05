@extends('layouts.app')
@section('content')
    <div class="m-content">
         <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            This is the list of Difinite SPV
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
                                        <th style="text-align:center;width:200px;">Supervisor ID</th>
                                        <th style="text-align:center;width:200px;">Action</th>
                                    </tr>
                        
                                    @foreach ($supervisors as $supervisor)
                                        <tr>
                                            <td style="text-align:center;"><b>{{++$i}}.</b></td>
                                            <td style="text-align:center;">{{$supervisor->name_supervisor}}</td>
                                            <td style="text-align:center;">{{$supervisor->id}}</td>
                                            <td>
                                                <form action="{{ route('supervisor.destroy', $supervisor->id)}}" method="post" style="width:180px;">
                                                   {{-- <a class="btn btn-sm btn-warning" href="{{route('employee.edit',$employee->id)}}">Edit</a> --}}
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
     
         <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__body">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                      <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add New SPV
                        </h3>
                    </div>
                </div>
            </div>

                        <form method="POST" action="{{ route('supervisor.store') }}">
                            @csrf
                            
                            <div class="col-md-12">
                                    <strong>Name Supervisor:</strong>
                                    <input id="name_supervisor" type="text" class="form-control @error('name_supervisor') is-invalid @enderror" name="name_supervisor" value="{{ old('name_supervisor') }}" required autocomplete="name_supervisor" autofocus>
                    
                                    @error('name_supervisor')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <br>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="float: right;">
                                    {{ __('Add') }}
                                </button>
                            </div>
                            
                        </form>

    </div>

    
    

@endsection