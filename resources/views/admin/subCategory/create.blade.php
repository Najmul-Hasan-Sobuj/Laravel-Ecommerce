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
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Category Create Form</h5>
                            </div>

                            <div class="card-body border-top">
                                <form action="{{ route('provider.category.store') }}" method="POST"
                                    class="from-prevent-multiple-submits">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Category: <span class="text-danger">*</span></label>
                                        <input type="text" id="category_name" name="category_name"
                                            class="form-control maxlength-options" maxlength="40" placeholder="Sports"
                                            required>
                                    </div>
                                    <div class="text-end">
                                        <button type="reset" class="btn btn-danger">Reset<i
                                                class="icon-reset"></i></button>
                                        {{-- <a href="{{ route('provider.category.index') }}" type="submit"
                                            class="btn btn-info">Back</a> --}}
                                        <button type="submit"
                                            class="btn btn-primary from-prevent-multiple-submits">Submit<i
                                                class="ph-paper-plane-tilt ms-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Sub-Category Create Form</h5>
                            </div>

                            <div class="card-body border-top">
                                <form action="{{ route('provider.category.store') }}" method="POST"
                                    class="from-prevent-multiple-submits">
                                    @csrf
                                    <div class="row mb-3">
                                        <label class="form-label">Category:</label>
                                        <select data-placeholder="Select your category name"
                                            class="form-control form-control-select2">
                                            <option></option>
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                            </optgroup>
                                            <optgroup label="Pacific Time Zone">
                                                <option value="CA">California</option>
                                                <option value="NV">Nevada</option>
                                                <option value="WA">Washington</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Sub-Category: <span class="text-danger">*</span></label>
                                        <input type="text" id="sub_category_name" name="sub_category_name"
                                            class="form-control maxlength-options" maxlength="40" placeholder="Sports"
                                            required>
                                    </div>
                                    <div class="text-end">
                                        <button type="reset" class="btn btn-danger">Reset<i
                                                class="icon-reset"></i></button>
                                        {{-- <a href="{{ route('provider.category.index') }}" type="submit"
                                            class="btn btn-info">Back</a> --}}
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
            <!-- /content area -->

            <!-- Footer -->
            @include('admin.layouts.components.footer')
            <!-- /footer -->

        </div>
        <!-- /inner content -->

    </div>
    <!-- /main content -->
@endsection
