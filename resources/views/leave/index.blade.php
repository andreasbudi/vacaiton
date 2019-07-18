@extends('layouts.app')
@section('content')

    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                    
                         @if (Auth::user()->role_id == '1')
                        <h3 class="m-portlet__head-text">
                            This is Your Leaves History and You Have {{(Auth::user()->leaves_available)}} Leave Available
                        </h3>

                         @else 
                        <h3 class="m-portlet__head-text">
                            This is Your Leave History 
                        </h3>
                        
                        @endif
                                                
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div>
                    <table class="table table-striped table-bordered" id="ajax_data" >
                        <thead>
                        <tr>
                            <th style="width:5%;"><b>No.</b></th>
                            <th style="width:15%;">Name</th>
                            <th style="width:10%;">From</th>
                            <th style="width:10%;">To</th>
                            <th style="width:10%;">Duration</th>
                            <th style="width:20%;">Reason</th>
                            <th style="width:15%;">Status</th>
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
                                columnDefs: [{"className": "text-center", "targets": "_all"}],
                                columns: [
                                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                    { data: 'name', name: 'users.name' },
                                    { data: 'from', name: 'from' },
                                    { data: 'to', name: 'to' },
                                    { data: 'duration', name: 'duration'},
                                    { data: 'reason', name: 'reason' },
                                    { data: 'action', name: 'action', orderable: false, searchable: false},
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

    @if (Auth::user()->role_id == '2')
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                         
                        <h3 class="m-portlet__head-text">
                            This is Your Team Leave History
                        </h3>
                                                
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div class="m_datatable" >
                    <table class="table table-striped table-bordered" id="ajax_dataTeamSpv" >
                        <thead>
                        <tr>
                            <th style="width:5%;"><b>No.</b></th>
                            <th style="width:15%;">Name</th>
                            <th style="width:10%;">From</th>
                            <th style="width:10%;">To</th>
                            <th style="width:10%;">Duration</th>
                            <th style="width:20%;">Reason</th>
                            <th style="width:15%;">Status</th>
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
                                columnDefs: [{"className": "text-center", "targets": "_all"}],
                                columns: [
                                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                    { data: 'name', name: 'users.name' },
                                    { data: 'from', name: 'from' },
                                    { data: 'to', name: 'to' },
                                    { data: 'duration', name: 'duration'},
                                    { data: 'reason', name: 'reason' },
                                    { data: 'action', name: 'action', orderable: false, searchable: false},
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