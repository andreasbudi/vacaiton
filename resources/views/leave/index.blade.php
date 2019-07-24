@extends('layouts.app')
@section('content')

@if (Auth::user()->role_id == '1')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="m-subheader__title m-subheader__title--separator">
                Hi, {{ (Auth::user()->name) }}
            </h3>
            <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item">
                            <span class="m-nav__link-text">
                                    <span style="color:#A0A0A0;">Leave remaining</span> <b>{{ (Auth::user()->leaves_available) }} days</b>
                            </span>
                    </li>
                    
                </ul>
        </div>
    </div>
</div>
    <!-- END: Subheader -->
@elseif (Auth::user()->role_id == '2')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                        Leaves History
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="/home" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="{{route('leave.index')}}" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Leaves History
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </div>
            <div>
                
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
@endif
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Your Leaves History 
                        </h3>                      
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div>
                    <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" id="ajax_data" >
                        <thead>
                        <tr>
                            <th style="width:5%;"><b>No.</b></th>
                            <th style="width:15%;">Name</th>
                            <th style="width:10%;">From</th>
                            <th style="width:10%;">To</th>
                            <th style="width:10%;">Duration</th>
                            <th style="width:20%;">Reason</th>
                            <th style="width:15%;">Status</th>
                            <th style="width:10%;">Approver</th>
                            <th style="width:20%;">Message</th>
                        </tr>
                    </thead>
                    </table>
                        @push('scripts')
                        <script>
                        $(function() {
                            $('#ajax_data').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: 'leave/json',
                                dom: '<"top"f>rt<"bottom"lip><"clear">',
                                columnDefs: [{"className": "text-center", "targets": "_all"},{targets:2, render:function(data){return moment(data).format('Do MMMM YYYY'); }},{targets:3, render:function(data){return moment(data).format('Do MMMM YYYY'); }}],
                                columns: [
                                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                    { data: 'name', name: 'users.name' },
                                    { data: 'from', name: 'from' },
                                    { data: 'to', name: 'to' },
                                    { data: 'duration', name: 'duration'},
                                    { data: 'reason', name: 'reason' },
                                    { data: 'action', name: 'action', orderable: false, searchable: false},
                                    { data: 'responded_by', name: 'responded_by'},
                                    { data: 'reject_message', name: 'reject_message'}
                                ]
                            });
                        });
                        </script>
                        @endpush
                </div>
                <!--end: Datatable -->
            </div>
        </div>


    @if (Auth::user()->role_id == '2')
 
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                         
                        <h3 class="m-portlet__head-text">
                            Your Team History
                        </h3>
                                                
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div class="m_datatable" >
                    <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" id="ajax_dataTeamSpv" >
                        <thead>
                        <tr>
                            <th style="width:5%;"><b>No.</b></th>
                            <th style="width:15%;">Name</th>
                            <th style="width:10%;">From</th>
                            <th style="width:10%;">To</th>
                            <th style="width:10%;">Duration</th>
                            <th style="width:20%;">Reason</th>
                            <th style="width:15%;">Status</th>
                            <th style="width:10%;">Approver</th>
                            <th style="width:20%;">Message</th>
                        </tr>
                    </thead>
                    </table>
                        @push('scripts')
                        <script>
                        $(function() {
                            $('#ajax_dataTeamSpv').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: 'leave/jsonTeamSpv',
                                dom: '<"top"f>rt<"bottom"lip><"clear">',
                                columnDefs: [{"className": "text-center", "targets": "_all"},{targets:2, render:function(data){return moment(data).format('Do MMMM YYYY'); }},{targets:3, render:function(data){return moment(data).format('Do MMMM YYYY'); }}],
                                columns: [
                                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                    { data: 'name', name: 'users.name' },
                                    { data: 'from', name: 'from' },
                                    { data: 'to', name: 'to' },
                                    { data: 'duration', name: 'duration'},
                                    { data: 'reason', name: 'reason' },
                                    { data: 'action', name: 'action', orderable: false, searchable: false},
                                    { data: 'responded_by', name: 'responded_by'},
                                    { data: 'reject_message', name: 'reject_message'}
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
    @endif

@endsection