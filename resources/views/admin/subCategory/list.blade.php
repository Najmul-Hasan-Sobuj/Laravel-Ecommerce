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
                                <a href="{{ route('provider.categories.category.create') }}"
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
                        <h5 class="mb-0 float-start">Sub Category Table</h5>
                    </div>

                    <div class="table-responsive">
                        <table id="subCategoryTable" class="table table-bordered table-striped table-hover"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="40%">Category Name</th>
                                    <th width="40%">Sub Category Name</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- data load from sub category table --}}
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
            $(function subCategory() {
                var table = $('#subCategoryTable').DataTable({
                    processing: false,
                    // searching: true,
                    // bPaginate: true,
                    // paging: true,
                    // ordering: true,
                    // info: true,
                    serverSide: true,
                    ajax: "{{ route('provider.categories.subCategory.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'category_name',
                            name: 'category_name'
                        },
                        {
                            data: 'sub_category_name',
                            name: 'sub_category_name'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endonce
@endpush
