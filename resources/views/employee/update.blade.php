@extends('layouts.app')
@section('content')
 
<div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                My Profile
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form action="{{route('employee.update',$employee->id)}}" method="post" class="m-form m-form--label-align-right">
                        @csrf
                        @method('PUT')
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="m-form__heading">
                                <h3 class="m-form__heading-title">
                                    Employee Info:
                                </h3>
                            </div>

                            @if (Auth::user()->role_id == '4' && $employee->role_id == 1)
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="name" class="form-control " value="{{{ ($employee->name) }}}" required autocomplete="name" autofocus>
                                        
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Email address:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="email" class="form-control " value="{{{ ($employee->email) }}}" required autocomplete="email" autofocus>
                                            @error('email')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror 
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Department:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="department" class="form-control " value="{{{ ($employee->department) }}}" required autocomplete="department" autofocus>
                                            @error('department')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror 
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Leaves Available:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="leaves_available" class="form-control " value="{{{ ($employee->leaves_available) }}}" required autocomplete="leaves_available" autofocus>
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Role:
                                    </label>
                                    <div class="col-lg-6">
                                            <select name="role_id" id="role_id" class="form-control" required autocomplete="role_id" autofocus>
                                                    <option value="">SELECT ROLE</option>
                                                    @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name_role}}</option>
                                                    @endforeach
                                            </select>
                                       
                                    </div>   
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Supervisor:
                                    </label>
                                    <div class="col-lg-6">
                                            <select name="manager_id" id="manager_id" class="form-control" required autocomplete="manager_id" autofocus>
                                                    <option value="">SELECT SUPERVISOR</option>
                                                    @foreach ($managers as $manager)
                                                    <option value="{{$manager->id}}">{{$manager->name_supervisor}}</option>
                                                    @endforeach
                                            </select>
                                        
                                    </div>
                            </div>
                            @elseif (Auth::user()->role_id == '4' && $employee->role_id == 2)
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="name" class="form-control " value="{{{ ($employee->name) }}}" required autocomplete="name" autofocus>
                                        
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Email address:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="email" class="form-control " value="{{{ ($employee->email) }}}" required autocomplete="email" autofocus>
                                            @error('email')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror 
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Department:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="department" class="form-control " value="{{{ ($employee->department) }}}" required autocomplete="department" autofocus>
                                            @error('department')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror 
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Leaves Available:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="leaves_available" class="form-control " value="{{{ ($employee->leaves_available) }}}" required autocomplete="leaves_available" autofocus>
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Role:
                                    </label>
                                    <div class="col-lg-6">
                                            <select name="role_id" id="role_id" class="form-control" required autocomplete="role_id" autofocus>
                                                    <option value="">SELECT ROLE</option>
                                                    @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name_role}}</option>
                                                    @endforeach
                                            </select>
                                       
                                    </div>   
                            </div>
                            @elseif (Auth::user()->role_id == '4' && $employee->role_id == 3)
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="name" class="form-control " value="{{{ ($employee->name) }}}" required autocomplete="name" autofocus>
                                        
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Email address:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="email" class="form-control " value="{{{ ($employee->email) }}}" required autocomplete="email" autofocus>
                                            @error('email')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror 
                                       
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Department:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" name="department" class="form-control " value="{{{ ($employee->department) }}}" required autocomplete="department" autofocus>
                                            @error('department')
                                               <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                               </span>
                                           @enderror 
                                       
                                    </div>
                            </div>
                            
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Role:
                                    </label>
                                    <div class="col-lg-6">
                                            <select name="role_id" id="role_id" class="form-control" required autocomplete="role_id" autofocus>
                                                    <option value="">SELECT ROLE</option>
                                                    @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name_role}}</option>
                                                    @endforeach
                                            </select>
                                       
                                    </div>   
                            </div>



                           @else
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Name:
                                </label>
                                <div class="col-lg-6">
                                        <input type="text" class="form-control " value="{{{ (Auth::user()->name) }}}" disabled>
                                    
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Email address:
                                </label>
                                <div class="col-lg-6">
                                        <input type="text" class="form-control " value="{{{ (Auth::user()->email) }}}" disabled>
                                   
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Department:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" class="form-control " value="{{{ (Auth::user()->department) }}}" disabled>
                                       
                                    </div>
                            </div>


                            @if (Auth::user()->role_id != '3' && Auth::user()->role_id != '4')
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Leaves Available:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" class="form-control " value="{{{ (Auth::user()->leaves_available) }}}" disabled>
                                       
                                    </div>
                            </div>
                            @endif

                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Role:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" class="form-control " value="{{Auth::user()->roles()->first()->name_role}}" disabled>     
                                       
                                    </div>   
                            </div>




                            @if (Auth::user()->role_id == '1')
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Supervisor:
                                    </label>
                                    <div class="col-lg-6">
                                            <input type="text" class="form-control " value="{{{ (Auth::user()->supervisors()->first()->name_supervisor) }}}" disabled>
                                        
                                    </div>
                            </div>
                            @endif
                        </div>
                        <div class="m-form__seperator m-form__seperator--dashed"></div>
                        <div class="m-form__section m-form__section--last">
                            <div class="m-form__heading">
                                <br>
                                <h4 class="m-form__heading-title">
                                    Edit your password?
                                </h4>
                            </div>
                            {{-- <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Old Password:
                                </label>
                                <div class="col-lg-6">
                                        <input id="password-old" type="password" class="form-control @error('password-old') is-invalid @enderror" name="password-old" required autocomplete="old-password">
                                   
                                </div>
                            </div> --}}
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    New Password:
                                </label>
                                <div class="col-lg-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                   
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-lg-2 col-form-label">
                                    Confirm Password:
                                </label>
                                <div class="col-lg-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                   
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                    


                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
            <!--begin::Portlet-->
            
            <!--end::Portlet-->
        </div>
    </div>          
@endsection
