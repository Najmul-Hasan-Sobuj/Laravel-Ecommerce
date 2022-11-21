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
                        <h6 class="mb-sm-0">Coupon Create Form</h6>
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
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <form action="{{ route('provider.coupon.store') }}" method="POST"
                                                class="from-prevent-multiple-submits">
                                                @csrf
                                                <div class="mb-4">
                                                    <label class="form-label">Coupon Code:<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="coupon_code" name="coupon_code"
                                                        class="form-control maxlength-options" maxlength="10"
                                                        placeholder="Enter Your Coupon Code" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Valid Date:<span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" id="valid_date" name="valid_date"
                                                        class="form-control"placeholder="Enter Your Valid Date" required>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Type:<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select" id="type" name="type"
                                                        data-placeholder="Select your type"
                                                        data-minimum-results-for-search="Infinity">
                                                        <option></option>
                                                        <option value="Fixed">Fixed
                                                        </option>
                                                        <option value="Percentage">Percentage</option>
                                                    </select>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Coupon Amount:<span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" id="coupon_amount" name="coupon_amount"
                                                        class="form-control maxlength-options" maxlength="10"
                                                        placeholder="Enter Your Coupon Amount" required>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Status:<span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-control select" id="status" name="status"
                                                        data-placeholder="Select your status"
                                                        data-minimum-results-for-search="Infinity">
                                                        <option></option>
                                                        <option value="Active">Active
                                                        </option>
                                                        <option value="In-Active">In-Active</option>
                                                    </select>
                                                </div>

                                                <div class="text-end">
                                                    <button type="reset" class="btn btn-danger">Reset<i
                                                            class="icon-reset"></i></button>
                                                    <a href="{{ route('provider.coupon.index') }}" type="submit"
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
