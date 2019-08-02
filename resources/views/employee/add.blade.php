@extends('layouts.app')
@section('content')

<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="/show" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{ route('employee.create')}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Add Employee
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
</div>
<!-- END: Subheader -->
<div class="m-content">
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
                                   Employee Form
                                </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form  method="POST" action="{{ route('employee.store') }}" class="m-form m-form--label-align-right">
                @csrf      
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">

                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Name:
                                    </label>
                                    <div class="col-lg-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Email address:
                                    </label>
                                    <div class="col-lg-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                        <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department') }}" required autocomplete="department">
                    
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
                                        <select name="role_id" id="role_id" class="form-control" required autocomplete="role_id">
                                            <option value="">SELECT ROLE</option>
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
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Supervised By
                                    </label>
                                    <div class="col-lg-6">
                                        <select name="manager_id" id="manager_id" class="form-control">
                                            <option value="">SELECT SUPERVISOR</option>
                                             @foreach ($managers as $manager)
                                            <option value="{{$manager->id}}">{{$manager->name_supervisor}}</option>
                                             @endforeach
                                         </select> 
                                    </div>
                            </div>
                            <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                            Leaves Available:
                                    </label>
                                    <div class="col-lg-6">
                                        <input id="leaves_available" type="text" class="form-control @error('leaves_available') is-invalid @enderror" name="leaves_available" value="{{ old('leaves_available') }}">  
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                    <button type="button" class="btn btn-secondary" style="color:black;" name="cancel" onclick="goPrev()">Cancel</button>
                                    <script>
                                    function goPrev()
                                    {
                                        window.history.back();
                                    }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>          
</div>          
@endsection
