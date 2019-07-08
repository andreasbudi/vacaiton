@extends('layouts.app')
@section('content')
    <div class="m-content">

            @if (Auth::user()->role_id == 3)
            <div class="row">
                    
                    <div class="col-lg-9">
                        <!--begin::Portlet-->
                        <div class="m-portlet" id="m_portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon">
                                            <i class="flaticon-calendar-2"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">
                                            My Calendar
                                        </h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-plus"></i>
                                                    <span>
                                                        Add Event
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="m--hide m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                            <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--icon m-btn--pill m-btn--air">
                                                <span>
                                                    <i class="la la-cog"></i>
                                                    <span>
                                                        Settings
                                                    </span>
                                                </span>
                                            </a>
                                            <div class="m-dropdown__wrapper">
                                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 52px;"></span>
                                                <div class="m-dropdown__inner">
                                                    <div class="m-dropdown__body">
                                                        <div class="m-dropdown__content">
                                                            <ul class="m-nav">
                                                                <li class="m-nav__section m-nav__section--first">
                                                                    <span class="m-nav__section-text">
                                                                        Quick Actions
                                                                    </span>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Activity
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Messages
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                                        <span class="m-nav__link-text">
                                                                            FAQ
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__item">
                                                                    <a href="" class="m-nav__link">
                                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                                        <span class="m-nav__link-text">
                                                                            Support
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                                <li class="m-nav__item">
                                                                    <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                                        Cancel
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div id="m_calendar"></div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                    <div class="col-lg-3">
                            <!--begin::Portlet-->
                            <div class="m-portlet" id="m_portlet">
                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-caption">
                                        <div class="m-portlet__head-title">
                                            <span class="m-portlet__head-icon">
                                                <i class="flaticon-add"></i>
                                            </span>
                                            <h3 class="m-portlet__head-text">
                                                Draggable Events
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div id="m_calendar_external_events" class="fc-unthemed">
                                        <div class='fc-event fc-event-external fc-start m-fc-event--primary m--margin-bottom-15' data-color="m-fc-event--primary">
                                            <div class="fc-title">
                                                <div class="fc-content">
                                                    Meeting
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="m-separator m-separator--dashed m-separator--space"></div>
                                        <div>
                                            <label class="m-checkbox m-checkbox--brand">
                                                <input type="checkbox" id='m_calendar_external_events_remove'>
                                                Remove after drop
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Portlet-->
                        </div>
            </div>

            <div class="m-portlet m-portlet--mobile">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                     Hi, {{(Auth::user()->name)}}<br>
                                     Please Approve Your Team Leave Request
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
                                            @if($getStaff->status == 1)
                                            <a class="btn btn-sm btn-success" value="send" href="{{route('approval.show',$getStaff->id)}}" style="margin-left:20px;">Approve</a>
                                            <a class="btn btn-sm btn-danger" value="send" href="{{route('approval.edit',$getStaff->id)}}">Reject</a>
                                            @elseif($getStaff->status == 2)
                                            <center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>
                                            @else
                                            <center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>
                                            @endif
        
                                            
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

            @elseif(Auth::user()->role_id == 2)
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                             Hi, {{(Auth::user()->name)}}<br>
                             Please Approve Your Team Leave Request
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
                                    @if($getStaff->status == 1)
                                    <a class="btn btn-sm btn-success" value="send" href="{{route('approval.show',$getStaff->id)}}" style="margin-left:20px;">Approve</a>
                                    <a class="btn btn-sm btn-danger" value="send" href="{{route('approval.edit',$getStaff->id)}}">Reject</a>
                                    @elseif($getStaff->status == 2)
                                    <center><span class="m-badge m-badge--success m-badge--wide">Approved</span></center>
                                    @else
                                    <center><span class="m-badge m-badge--danger m-badge--wide">Rejected</span></center>
                                    @endif

                                    
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
        @endif
    </div>


@endsection