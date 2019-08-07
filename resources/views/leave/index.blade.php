@extends('layouts.app')
@section('content')

{{-- jika akun deactivated --}}
@if (Auth::user()->isActivated == '0')
    <script>
    alert("Your account is deactivated. Please contact administrator")
    </script>
@endif

{{-- tampilan staff tanpa breadcrumbs --}}
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
                        <span style="color:#A0A0A0;">Remaining leave</span> <b>{{ (Auth::user()->leaves_available) }} days</b>
                    </span>
                </li> 
            </ul>
        </div>
    </div>
</div>
<!-- END: Subheader -->

{{-- jika spv keluarkan breadcrumbs --}}
@elseif (Auth::user()->role_id == '2')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
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
                            Leave History
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
                            <span class="m-portlet__head-icon">
                                    <i class="flaticon-user"></i>
                            </span> 
                        <h3 class="m-portlet__head-text m--font-brand">
                            Your Leave History 
                        </h3>                      
                    </div>
                </div>
            </div>
            
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div class="table-responsive">
                    <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" id="ajax_data" style="width:100%;">
                        <thead>
                        <tr>
                            <th style="width:1%;"><b>No.</b></th>
                            <th style="width:10%;">Name</th>
                            <th style="width:9%;">Leave Type</th>
                            <th style="width:10%;">From</th>
                            <th style="width:10%;">To</th>
                            <th style="width:1%;">Duration</th>
                            <th style="width:15%;">Reason</th>
                            <th style="width:15%;">Status</th>
                            <th style="width:10%;">Approver</th>
                            <th style="width:15%;">Message</th>
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
                            columnDefs: [{"className": "text-center", "targets": "_all"},{targets:3, render:function(data){return moment(data).format('D MMMM YYYY'); }},{targets:4, render:function(data){return moment(data).format('D MMMM YYYY'); }}],
                            columns: [
                                 { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                 { data: 'name', name: 'users.name' },
                                 { data: 'leave_type', name: 'leave_type' },
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

    {{-- tampilan spv dengan team history --}}
    @if (Auth::user()->role_id == '2')
 
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                                <i class="flaticon-users"></i>
                        </span> 
                        <h3 class="m-portlet__head-text m--font-brand">
                            Your Team History
                        </h3>                       
                    </div>
                </div>
            </div>

            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div class="table-responsive">
                    <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" id="ajax_dataTeamSpv" style="width:100%;">
                        <thead>
                        <tr>
                            <th style="width:1%;"><b>No.</b></th>
                            <th style="width:10%;">Name</th>
                            <th style="width:9%;">Leave Type</th>
                            <th style="width:10%;">From</th>
                            <th style="width:10%;">To</th>
                            <th style="width:1%;">Duration</th>
                            <th style="width:15%;">Reason</th>
                            <th style="width:15%;">Status</th>
                            <th style="width:10%;">Approver</th>
                            <th style="width:15%;">Message</th>
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
                            columnDefs: [{"className": "text-center", "targets": "_all"},{targets:3, render:function(data){return moment(data).format('D MMMM YYYY'); }},{targets:4, render:function(data){return moment(data).format('D MMMM YYYY'); }}],
                            columns: [
                                 { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                 { data: 'name', name: 'users.name' },
                                 { data: 'leave_type', name: 'leave_type' },
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