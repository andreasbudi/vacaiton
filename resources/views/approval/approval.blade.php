@extends('layouts.app')
@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Approval Form
                        </h3>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
            @endif

            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="Search..." id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="m-separator m-separator--dashed d-xl-none"></div>
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m_datatable" id="base_responsive_columns">
                    <table class="table table-hover table-sm" >
                        <tr>
                            <th width="50px"style="text-align:center;"><b>No.</b></th>
                            <th style="text-align:center;width:200px;">Name</th>
                            <th style="text-align:center;width:200px;">From</th>
                            <th style="text-align:center;width:200px;">To</th>
                            <th style="text-align:center;width:200px;">Duration</th>
                            <th style="text-align:center; width:300px;">Reason</th>
                            <th style="text-align:center; width:100px;">Status</th>
                            <th style="text-align:center; width:100px;"></th>
                        </tr>
            
                        @foreach ($getStaffs as $getStaff)
                            <tr>
                                <td style="text-align:center;"><b>{{++$i}}.</b></td>
                                <td style="text-align:center;">{{$getStaff->users->name}}</td>
                                <td style="text-align:center;">{{$getStaff->from}}</td>
                                <td style="text-align:center;">{{$getStaff->to}}</td>
                                <td style="text-align:center;">{{$getStaff->duration}} days</td>
                                <td style="text-align:center;">{{$getStaff->reason}}</td>
                                <td style="text-align:center;">{{$getStaff->status}}</td>
                                <td>
                                <form style="width:180px;">
                                    <a class="btn btn-sm btn-success" value="send" href="{{route('approval.show',$getStaff->id)}}">Approve</a>
                                    <a class="btn btn-sm btn-danger" value="send" href="{{route('approval.edit',$getStaff->id)}}">Reject</a>
                                </form>
                                </td>
                            </tr>
                            
                        @endforeach
            
                    </table>
            
                    {!! $getStaffs->links() !!}
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>


@endsection