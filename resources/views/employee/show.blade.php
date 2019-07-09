@extends('layouts.app')
@section('content')
    <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Hi, {{(Auth::user()->name)}}<br>
                                This is List Member of Difinite 
                            </h3>
                        </div>
                    </div>
                </div>
    
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
                @endif
    
                
                    <!--begin: Datatable -->
                    <div class="m_datatable" >
                        <table class="table table-hover table-sm" id="ajax_data" >
                            <thead>
                            <tr>
                                <th><b>No.</b></th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Leaves Available</th>
                                <th>Role</th>
                                <th>Supervisor</th>
                                <th style=" text-align:center;">Action</th>
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
                                    columns: [
                                        { data: 'id', name: 'users.id' },
                                        { data: 'name', name: 'users.name' },
                                        { data: 'department', name: 'users.department' },
                                        { data: 'email', name: 'users.email' },
                                        { data: 'leaves_available', name: 'users.leaves_available' },
                                        { data: 'name_role', name: 'roles.name_role' },
                                        { data: 'name_supervisor', name: 'supervisors.name_supervisor' },
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
@endsection