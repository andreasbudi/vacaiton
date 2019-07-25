@extends('layouts.app')
@section('content')
<style>
td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
</style>
<!-- BEGIN: Subheader -->
<div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                        Add Supervisor
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="/show" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="/showsupervisor" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Add Supervisor
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
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">      
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Supervisor Management
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                            <button href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"  data-toggle="modal" data-target="#m_modal_4">Add Supervisor</button>
                            <div class="modal fade" id="m_modal_4" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">
                                                    &times;
                                                </span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('supervisor.store') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label class="form-control-label" style="color:black;">
                                                    Name
                                                </label>
                                                <input id="name_supervisor" type="text" class="form-control @error('name_supervisor') is-invalid @enderror" name="name_supervisor"  required autocomplete="name_supervisor" autofocus>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label" style="color:black;">
                                                    Email
                                                </label>
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="color:black;">Close</button>
                                            <button type="submit" class="btn btn-sm btn-primary">{{ __('Add') }}</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
            @endif
            <!--begin: Datatable -->
            <div>
                <table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" id="ajax_data" >
                    <thead>
                    <tr>
                        <th style="width:3%;"></th>
                        <th style="width:40%;">Name</th>
                        <th style="width:30%;">Email</th>
                    </tr>
                </thead>
                </table>
                @push('scripts')
                <script>
                // $(function() {
                //     $('#ajax_data').DataTable({
                //         processing: true,
                //         serverSide: true,
                //         ajax: 'supervisor/json',
                //         dom: '<"top"f>rt<"bottom"lip><"clear">',
                //         columnDefs: [{"className": "text-center", "targets": "_all"}],
                //         columns: [
                //             { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                //             { data: 'name_supervisor', name: 'supervisors.name_supervisor' },
                //             { data: 'action', name: 'action', orderable: false, searchable: false}
                //         ]
                //     });
                // });

                /* Formatting function for row details - modify as you need */
                function format ( d ) {
                    // `d` is the original data object for the row
                    return '<table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-hover" cellpadding="5" cellspacing="0" border="0">'+
                        '<tr>'+
                            '<td style="width:15%; text-align:center;">Team Member :</td>'+
                            '<td style="font-style: italic;">'+d.name+'</td>'+
                        '</tr>'+
                    '</table>';
                }
                
                $(document).ready(function() {
                    var table =  $('#ajax_data').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: 'supervisor/json',
                        dom: '<"top"f>rt<"bottom"lip><"clear">',
                        columnDefs: [{"className": "text-center", "targets": "_all"}],
                        columns: [
                            {
                            "className":      'details-control',
                            "orderable":      false,
                            "data":           null,
                            "defaultContent": ''
                            },
                            { data: 'name_supervisor', name: 'supervisors.name_supervisor' },
                            { data: 'email', name: 'supervisors.email' }
                        ]
                    });
                    
                    // Add event listener for opening and closing details
                    $('#ajax_data tbody').on('click', 'td.details-control', function () {
                        var tr = $(this).closest('tr');
                        var row = table.row( tr );
                
                        if ( row.child.isShown() ) {
                            // This row is already open - close it
                            row.child.hide();
                            tr.removeClass('shown');
                        }
                        else {
                            // Open this row
                            row.child( format(row.data()) ).show();
                            tr.addClass('shown');
                        }
                    } );
                } );

                

                </script>
                @endpush
            </div>
            <!--end: Datatable -->
        </div>        
    </div>
</div>
@endsection