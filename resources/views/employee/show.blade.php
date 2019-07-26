@extends('layouts.app')
@section('content')
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title">
                        Hi, {{ (Auth::user()->name) }}
                </h3>
            </div>
            <div>
                
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Employee Management 
                            </h3>
                        </div>
                    </div>
                </div>
                <script>
                    @if(Session::has('message'))
                      var type = "{{ Session::get('alert-type', 'info') }}";
                      switch(type){
                          case 'info':
                              toastr.info("{{ Session::get('message') }}");
                              break;
                          case 'warning':
                              toastr.warning("{{ Session::get('message') }}");
                              break;
                          case 'success':
                              toastr.success("{{ Session::get('message') }}");
                              break;
                          case 'error':
                              toastr.error("{{ Session::get('message') }}");
                              break;
                      }
                    @endif
                  </script>
                    <!--begin: Datatable -->
                    <div class="m-portlet__body">
                        <div class="table-responsive">
                            <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" id="ajax_data" style="width:100%;">
                                <thead>
                                <tr>
                                    <th><b>No.</b></th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Leaves Available</th>
                                    <th>Role</th>
                                    <th>Supervisor</th>
                                    <th>Action</th>
                                    <th>isActivated</th>
                                </tr>
                            </thead>
                            </table>

                                @push('scripts')
                                <script>
                                $(function() {
                                    $('#ajax_data').DataTable({
                                        processing: true,
                                        serverSide: true,
                                        ajax: 'show/json',
                                        dom: '<"top"f>rt<"bottom"lip><"clear">',
                                        columnDefs: [{"className": "text-center", "targets": "_all"},{"targets": [ 8 ],"visible": false}],
                                        columns: [
                                            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                                            { data: 'name', name: 'users.name' },
                                            { data: 'department', name: 'users.department' },
                                            { data: 'email', name: 'users.email' },
                                            { data: 'leaves_available', name: 'users.leaves_available' },
                                            { data: 'name_role', name: 'roles.name_role' },
                                            { data: 'name_supervisor', name: 'supervisors.name_supervisor' },
                                            { data: 'action', name: 'action', orderable: false, searchable: false},
                                            { data: 'isActivated', name: 'users.isActivated'},
                                        ],
                                        rowCallback: function( row, data, index ) {
                                        if (data.isActivated == '0') {
                                            $('td', row).css('background-color', '#ff706e');
                                        }
                                        } 
                                    });
                                });
                                </script>
                                @endpush
                        </div>
                    </div>
                    <!--end: Datatable -->
                    
            </div>
        </div>
@endsection