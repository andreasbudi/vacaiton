@extends('layouts.app')
@section('content')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                         
                        <h3 class="m-portlet__head-text">
                            Hi, {{(Auth::user()->name)}}<br>
                            This is Your Leaves History
                        </h3>

                        
                        
                        
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Search Form -->
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Status:
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select" id="m_form_status">
                                                <option value="">
                                                    All
                                                </option>
                                                <option value="1">
                                                    Waiting for Approval
                                                </option>
                                                <option value="2">
                                                    Approved
                                                </option>
                                                <option value="3">
                                                    Rejected
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
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
                    </div>
                </div>
                <!--end: Search Form -->
                <!--begin: Datatable -->
                <div class="m_datatable" id="ajax_data">
                    <table class="table table-hover table-sm" >
                        <tr>
                            <th width="50px"style="text-align:center;"><b>No.</b></th>
                            <th style="text-align:center;width:300px;">From</th>
                            <th style="text-align:center;width:300px;">To</th>
                            <th style="text-align:center;width:200px;">Duration</th>
                            <th style="text-align:center;width:200px;">Reason</th>
                            <th style="text-align:center;width:300px;">Status</th>
                            <th style="text-align:center;"></th>
                        </tr>
            
                        @foreach ($leaves as $leave)
                            <tr>
                                <td style="text-align:center;"><b>{{++$i}}.</b></td>
                                <td style="text-align:center;">{{$leave->from}}</td>
                                <td style="text-align:center;">{{$leave->to}}</td>
                                <td style="text-align:center;">{{$leave->duration}} days</td>
                                <td style="text-align:center;">{{$leave->reason}}</td>
                                <th>
                                        @if($leave->status == 1)
                                        <center><span class="label label-info">Waiting for Approval</span></center>
                                        @elseif($leave->status == 2)
                                        <center><span class="label label-danger">Approved</span></center>
                                        @elseif($leave->status == 3)
                                        <center><span class="label label-danger">Rejected</span></center>
                                        @endif
                
                                    </th>
                                <td>
                                    <form action="{{ route('leave.destroy', $leave->id)}}" method="post" style="width:180px;">
                                        <a class="btn btn-sm btn-warning" href="{{route('leave.edit',$leave->id)}}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
            
                    </table>
                    {!! $leaves->links() !!}
                </div>
                <!--end: Datatable -->
            </div>
        </div>
    </div>

@endsection