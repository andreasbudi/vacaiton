@extends('layouts.app')
@section('content')

    <div class="col-xl-12" style="width:800px; height:700px;">
        <!--begin:: Widgets/Tasks -->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add Employee
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="m-widget2">
                        <form method="POST" action="{{ route('employee.store') }}">
                            @csrf
                            
                            <div class="col-md-12">
                                    <strong>Name :</strong>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="col-md-12">
                                    <strong>Department :</strong>
                                        <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                                    @error('department')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                          
                            <div class="col-md-12">
                                    <strong>E-mail :</strong>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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

                            @if (Auth::user()->role_id != '3' && Auth::user()->role_id != '4')
                            <div class="col-md-12">
                                    <strong>Leaves Available :</strong>
                                    <input id="leaves_available" type="text" class="form-control @error('leaves_available') is-invalid @enderror" name="leaves_available" value="{{ old('leaves_available') }}" required autocomplete="leaves_available" autofocus>
                    
                                    @error('leaves_available')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            
                            <div class="col-md-12">
                                    <strong>Role :</strong>
                                    <select name="role_id" id="role_id" class="form-control">
                                        @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name_role}}</option>
                                        @endforeach
                                    </select>

                                    @error('role_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>


                            <div class="col-md-12">
                                    <strong>Supervised By :</strong>
                                    <select name="manager_id" id="manager_id" class="form-control">
                                        @foreach ($managers as $manager)
                                        <option value="{{$manager->id}}">{{$manager->name}}</option>
                                        @endforeach
                                    </select>

                                    @error('manager_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <br>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="float: right;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Tasks -->
    </div>
@endsection
