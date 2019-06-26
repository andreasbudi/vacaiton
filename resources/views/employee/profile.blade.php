@extends('layouts.app')
@section('content')


<div class="col-xl-12" style="width:800px;">
        <!--begin:: Widgets/Tasks -->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            My Profile
                        </h3>
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
                    
                            <div class="col-md-12">
                                    <strong>Leaves Available :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->leaves_available) }}}" disabled>
                            </div>

                            {{-- <div class="col-md-12">
                                    <strong>Role :</strong>
                                    
                                    $user = User::find(1);
                                    echo $book->author->name;
                                    <input type="text" class="form-control " value="{{{ (users()->roles->name_role) }}}" disabled>
                            </div>

                            <div class="col-md-12">
                                    <strong>Supervisor :</strong>
                                    <input type="text" class="form-control " value="{{{ (Auth::user()->supervisors->name) }}}" disabled>
                            </div> --}}

                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end:: Widgets/Tasks -->
    </div>
@endsection

