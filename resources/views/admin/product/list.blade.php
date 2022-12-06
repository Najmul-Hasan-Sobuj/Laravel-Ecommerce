@extends('admin.layouts.app')

@section('admincontent')
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
                                <button class="btn btn-sm btn-flat-danger" id="multi-delete" formId="pickUpPointTable"
                                    multiDeleteLinkUrl="{{ route('provider.pickUpPointMultiDelete') }}">Delete
                                    Selected Items</button>

                                <a href="{{ route('provider.pickUpPoint.create') }}"
                                    class="btn btn-flat-success btn-labeled btn-labeled-start btn-sm float-end mx-1"><span
                                        class="btn-labeled-icon bg-success text-white">
                                        <i class="icon-plus2"></i>
                                    </span>
                                    Add New
                                </a>
                                <a href="{{ route('provider.pickUpPoint.create') }}"
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
                        <h5 class="mb-0 float-start">Pick-Up Point Table</h5>
                    </div>

                    <div class="table-responsive">
                        <table id="pickUpPointTable" class="table table-bordered table-striped table-hover"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th width="5%"><input id="select-all-checkbox" type="checkbox"
                                            class="form-check-input"></th>
                                    <th width="5%">SL</th>
                                    <th width="15%">Name</th>
                                    <th width="30%">Address</th>
                                    <th width="15%">Primary Number</th>
                                    <th width="15%">Secondary Number</th>
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
    <script type="text/javascript">
        $(function pickUpPoint() {
            var table = $('#pickUpPointTable').DataTable({
                processing: false,
                // searching: true,
                // bPaginate: true,
                // paging: true,
                // ordering: true,
                // info: true,
                serverSide: true,
                ajax: "{{ route('provider.pickUpPoint.index') }}",
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'phone_one',
                        name: 'phone_one'
                    },
                    {
                        data: 'phone_two',
                        name: 'phone_two'
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
            $('#pickUpPointTable tbody').on('change', 'input[type="checkbox"]', function() {
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
        });
    </script>
@endpush
