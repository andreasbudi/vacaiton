@extends('layouts.app')
@section('content')

            <div class="col-xl-12" style="width:800px;">
                <!--begin:: Widgets/Tasks -->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title" style="width:700px;">
                                <h3 class="m-portlet__head-text">
                                    Edit Profile
                                </h3>
                            </div>
                        </div>
                    </div>
        
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> there where some problems with your input.<br>
                        <ul>
                            @foreach ($errors as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="m-portlet__body">
                        <div class="tab-content">
                            <div class="m-widget2">
                                <form action="{{route('employee.update',$employee->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-12">
                                        <strong>Name :</strong>
                                           <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$employee->name}}" required autocomplete="name" autofocus>
                                       
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror 
                                    </div>
                                    <div class="col-md-12">
                                        <strong>E-mail :</strong>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$employee->email}}" required autocomplete="email">
                    
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror 
                                    </div>
                                    <div class="col-md-12">
                                        <strong>Password :</strong>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                               @error('password')
                                                   <span class="invalid-feedback" role="alert">
                                                       <strong>{{ $message }}</strong>
                                                   </span>
                                               @enderror
                                   </div>

                                   <div class="col-md-12">
                                        <strong>Confirm Password :</strong>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                     </div>
                                    <br>
                                    <div class="col-md-12">
                                            <button type="submit" class="btn btn-sm btn-primary" style="float:right;">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/Tasks -->
        </div>
@endsection
