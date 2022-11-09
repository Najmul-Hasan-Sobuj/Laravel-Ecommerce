@extends('admin.layouts.app')

@section('admincontent')
    <style>
        .dataTables_length,
        .dataTables_info {
            margin-right: 0.3125rem !important;
            margin-left: 0.3125rem !important;
            margin-top: 0.3125rem !important;
            float: left !important;
        }

        .dataTables_filter,
        .dataTables_paginate {
            margin-right: 0.3125rem !important;
            margin-left: 0.3125rem !important;
            margin-top: 0.3125rem !important;
            float: right !important;
        }

        .table-responsive {
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
        }
    </style>
    <!-- Main content -->
    <div class="content-wrapper">

        <!-- Inner content -->
        <div class="content-inner">

            <!-- Page header -->
            @include('admin.layouts.components.pageHeader')
            <!-- /page header -->

            <!-- Content area -->
            <div class="content">

                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center">
                        <h6 class="mb-sm-0">Switch and controls</h6>
                        <div class="ms-sm-auto">
                            <div class="hstack gap-3 justify-content-between">
                                <label class="form-check form-switch form-check-reverse">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label">Enable</span>
                                </label>

                                <div class="hstack gap-2">
                                    <a class="text-body" data-card-action="collapse">
                                        <i class="ph-caret-down"></i>
                                    </a>
                                    <a class="text-body" data-card-action="reload">
                                        <i class="ph-arrows-clockwise"></i>
                                    </a>
                                    <a class="text-body" data-card-action="remove">
                                        <i class="ph-x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="collapse show">
                        <div class="card-body">
                            <div class="mb-3">
                                <button class="btn btn-sm btn-flat-danger" id="multi-delete">Delete
                                    Selected Items</button>

                                <a href="{{ route('provider.brand.create') }}"
                                    class="btn btn-flat-success btn-labeled btn-labeled-start btn-sm float-end mx-1"><span
                                        class="btn-labeled-icon bg-success text-white">
                                        <i class="icon-plus2"></i>
                                    </span>
                                    Add New
                                </a>
                                <a href="{{ route('provider.categories.category.create') }}"
                                    class="btn btn-flat-info btn-labeled btn-labeled-start btn-sm float-end"><span
                                        class="btn-labeled-icon bg-info text-white">
                                        <i class="icon-trash"></i>
                                    </span>
                                    Delete forever
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 float-start">Category Table</h5>
                    </div>

                    <div class="table-responsive">
                        <table id="categoryTable" class="table table-bordered table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%"><input id="select-all-checkbox" type="checkbox"
                                            class="form-check-input"></th>
                                    <th width="10%">SL</th>
                                    <th width="80%">Category Name</th>
                                    <th class="text-center" width="5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- data load from category table --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /bordered table -->
            </div>
            <!-- /content area -->


            <!-- Footer -->
            @include('admin.layouts.components.footer')
            <!-- /footer -->

        </div>
        <!-- /inner content -->

    </div>
    <!-- /main content -->
@endsection

@push('script')
    @once
        <script type="text/javascript">
            $(function category() {
                var table = $('#categoryTable').DataTable({
                    processing: false,
                    // searching: true,
                    // bPaginate: true,
                    // paging: true,
                    // ordering: true,
                    // info: true,
                    serverSide: true,
                    ajax: "{{ route('provider.categories.category.index') }}",
                    columns: [{
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                            exportable: false,
                            printable: true,

                        },
                        {
                            orderable: false,
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                // Handle click on "Select all" control
                $('#select-all-checkbox').on('click', function() {
                    // Get all rows with search applied
                    var rows = table.rows({
                        'search': 'applied'
                    }).nodes();
                    // Check/uncheck checkboxes for all rows in the table
                    $('input[type="checkbox"]', rows).prop('checked', this.checked);
                });

                // Handle click on checkbox to set state of "Select all" control
                $('#categoryTable tbody').on('change', 'input[type="checkbox"]', function() {
                    // If checkbox is not checked
                    if (!this.checked) {
                        var el = $('#select-all-checkbox').get(0);
                        // If "Select all" control is checked and has 'indeterminate' property
                        if (el && el.checked && ('indeterminate' in el)) {
                            // Set visual state of "Select all" control
                            // as 'indeterminate'
                            el.indeterminate = true;
                        }
                    }
                });

                //multiple delete data click one single button
                $('#multi-delete').on('click', function() {
                    var rowIds = [];
                    $('#categoryTable input[name="rowId[]"]:checked').each(function() {
                        rowIds[rowIds.length] = (this.checked ? $(this).val() : "");
                    });
                    console.log('rowIds ', rowIds);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    swalInit.fire({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!",

                        preConfirm: function() {
                            $.ajax({
                                url: "{{ route('provider.categories.categoryMultiDelete') }}",
                                method: "POST",
                                data: {
                                    'rowIds': rowIds
                                },
                                dataType: 'json',
                                success: function(data) {
                                    swalInit.fire({
                                        title: "Deleted!",
                                        text: "This data has been deleted!",
                                        confirmButtonColor: "#66BB6A",
                                        icon: "success",
                                        type: "success",
                                        preConfirm: function() {
                                            location.reload();
                                        },
                                    });
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    swalInit.fire({
                                        title: "Oops...",
                                        text: "Seems you couldn't submit form for a longtime. Please refresh your form & try again",
                                        icon: "error",
                                        allowEscapeKey: false,
                                        allowEnterKey: false,
                                    });
                                },
                            });
                        },
                    });
                });

            });
        </script>
    @endonce
@endpush
