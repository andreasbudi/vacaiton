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
                                                All employees
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div class="fc-unthemed">
                                        @foreach ($leaves as $leave)
                                        <div class='fc-event fc-event-external fc-start m-fc-event--primary m--margin-bottom-15' data-color="m-fc-event--primary">
                                            <div class="fc-title">
                                                <div class="fc-content" style="margin-top:7px;">
                                                    <p style="font-size:13px;">{{$leave->users->name}}</p>
                                                    <p>{{$leave->from}} - {{$leave->to}}</p>
                                                    <p style="font-size:12px;">{{$leave->duration}} days</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
                        <!--begin: Datatable -->
                        <div class="m_datatable" >
                            <table class="table table-hover table-sm" id="ajax_data" >
                                <thead>
                                <tr>
                                    <th><b>No.</b></th>
                                    <th>Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Duration</th>
                                    <th>Reason</th>
                                    <th style="width:15%; text-align:center;">Action</th>
                                </tr>
                            </thead>
                            </table>
                                @push('scripts')
                                <script>
                                $(function() {
                                    $('#ajax_data').DataTable({
                                        processing: true,
                                        serverSide: true,
                                        ajax: 'home/json',
                                        columns: [
                                            { data: 'id', name: 'leaves.id' },
                                            { data: 'name', name: 'users.name' },
                                            { data: 'from', name: 'from' },
                                            { data: 'to', name: 'to' },
                                            { data: 'duration', name: 'duration' },
                                            { data: 'reason', name: 'reason' },
                                            {data: 'action', name: 'action', orderable: false, searchable: false}
                                        ]
                                    });
                                });
                                </script>
                                @endpush
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
                <!--begin: Datatable -->
                <div class="m_datatable" >
                    <table class="table table-hover table-sm" id="ajax_data" >
                        <thead>
                        <tr>
                            <th><b>No.</b></th>
                            <th>Name</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Duration</th>
                            <th>Reason</th>
                            <th style="width:15%; text-align:center;">Action</th>
                        </tr>
                    </thead>
                    </table>
                        @push('scripts')
                        <script>
                        $(function() {
                            $('#ajax_data').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: 'home/json',
                                columns: [
                                    { data: 'id', name: 'leaves.id' },
                                    { data: 'name', name: 'users.name' },
                                    { data: 'from', name: 'from' },
                                    { data: 'to', name: 'to' },
                                    { data: 'duration', name: 'duration' },
                                    { data: 'reason', name: 'reason' },
                                    {data: 'action', name: 'action', orderable: false, searchable: false}
                                ]
                            });
                        });
                        </script>
                        @endpush
                </div>
                <!--end: Datatable -->
            </div>
        </div>
        @endif
    </div>


@endsection