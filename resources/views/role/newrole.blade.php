@extends('layouts.app')
@section('content')

    <div class="col-xl-12" style="width:800px; height:700px;">
        <!--begin:: Widgets/Tasks -->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Add New Role
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="m-widget2">
                        <form method="POST" action="{{ route('role.store') }}">
                            @csrf
                            
                            <div class="col-md-12">
                                    <strong>Name Role:</strong>
                                    <input id="name_role" type="text" class="form-control @error('name_role') is-invalid @enderror" name="name_role" value="{{ old('name_role') }}" required autocomplete="name_role" autofocus>
                    
                                    @error('name_role')
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
                </div>
            </div>
        </div>
        <!--end:: Widgets/Tasks -->
    </div>
@endsection
