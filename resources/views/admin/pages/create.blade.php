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
                        <h6 class="mb-sm-0">Create A New Page</h6>
                        <div class="ms-sm-auto">
                            <div class="hstack gap-3 justify-content-between">
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
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <form action="{{ route('provider.pages.store') }}" method="POST"
                                                class="from-prevent-multiple-submits">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label">Page Position: <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="page_position" name="page_position"
                                                                class="form-control maxlength-options" maxlength="40"
                                                                placeholder="Enter Your Page Position">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label">Page Name: <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="page_name" name="page_name"
                                                                class="form-control maxlength-options" maxlength="40"
                                                                placeholder="Enter Your Page Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mb-4">
                                                            <label class="form-label">Page Title: <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" id="page_title" name="page_title"
                                                                class="form-control maxlength-options" maxlength="40"
                                                                placeholder="Enter Your Page Title">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <textarea class="form-control" id="ckeditor_classic_empty" name="description" placeholder="Enter your text..."></textarea>
                                                </div>

                                                <div class="text-end">
                                                    <button type="reset" class="btn btn-danger">Reset<i
                                                            class="icon-reset"></i></button>
                                                    <a href="{{ route('provider.pages.index') }}" type="submit"
                                                        class="btn btn-info">Back</a>
                                                    <button type="submit"
                                                        class="btn btn-primary from-prevent-multiple-submits">Submit<i
                                                            class="ph-paper-plane-tilt ms-2"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
