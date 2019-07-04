@extends('layouts.app')
@section('content')
<div class="col-xl-12" style="width:800px;">
        <!--begin:: Widgets/Tasks -->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title" style="width:700px;">
                        <h3 class="m-portlet__head-text">
                            My Profile
                        </h3>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item m-portlet__nav-item--last">
                                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                        <a href="{{route('employee.edit',Auth::user())}}" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                            <i class="la la-gear"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="m-widget2">
                        <form>
                            <div class="col-md-12">
                                    <strong>Name :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->name) }}}" disabled>
                            </div>
                            
                            <div class="col-md-12">
                                    <strong>E-mail :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->email) }}}" disabled>
                            </div>
                            
                            <div class="col-md-12">
                                    <strong>Department :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->department) }}}" disabled>
                            </div>
                    
                            @if (Auth::user()->role_id != '3' && Auth::user()->role_id != '4')
                            <div class="col-md-12">
                                    <strong>Leaves Available :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->leaves_available) }}}" disabled>
                            </div>
                            @endif

                            <div class="col-md-12">
                                    <strong>Role :</strong>
                                    <input type="text" class="form-control " value="{{Auth::user()->roles()->first()->name_role}}" disabled>     
                            </div>

                            @if (Auth::user()->role_id == '1')
                            <div class="col-md-12">
                                    <strong>Supervisor :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->supervisors()->first()->name_supervisor) }}}" disabled>
                            </div>
                            @elseif (Auth::user()->role_id == '2')
                            <div class="col-md-12">
                                    <strong>My Team :</strong>
                                    @foreach ($users as $user)
                                    <input type="text" class="form-control " value="{{{ $user->name }}}" disabled>
                                    @endforeach
                                    
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Tasks -->
</div>
@endsection

