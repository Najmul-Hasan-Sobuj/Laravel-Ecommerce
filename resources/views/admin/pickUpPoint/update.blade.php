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
                        <h6 class="mb-sm-0">Pick-Up Point Update Form</h6>
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
                                            <form action="{{ route('provider.pickUpPoint.update', [$pickUpPoint->id]) }}"
                                                method="POST" class="from-prevent-multiple-submits">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label class="form-label">Name:<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="name" name="name"
                                                        value="{{ $pickUpPoint->name }}"
                                                        class="form-control maxlength-options" maxlength="40"
                                                        placeholder="Enter Your Name" required>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Address:<span
                                                            class="text-danger">*</span></label>
                                                    <textarea id="address" name="address" rows="2" cols="3" maxlength="150"
                                                        class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ $pickUpPoint->name }}</textarea>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label">Primary Phone Number:</label>
                                                    <input type="number" id="phone_one" name="phone_one"
                                                        value="{{ $pickUpPoint->phone_one }}"
                                                        class="form-control maxlength-options" maxlength="40"
                                                        placeholder="Enter Your Primary Phone Number">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Secondary Phone Number:</label>
                                                    <input type="number" id="phone_two" name="phone_two"
                                                        value="{{ $pickUpPoint->phone_two }}"
                                                        class="form-control maxlength-options" maxlength="40"
                                                        placeholder="Enter Your Secondary Phone Number">
                                                </div>

                                                <div class="text-end">
                                                    <button type="reset" class="btn btn-danger">Reset<i
                                                            class="icon-reset"></i></button>
                                                    <a href="{{ route('provider.pickUpPoint.index') }}" type="submit"
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
