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
                        <h6 class="mb-sm-0">Breand Update Form</h6>
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
                                            <form action="{{ route('provider.brand.update', [$brand->id]) }}" method="POST"
                                                class="from-prevent-multiple-submits" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label class="form-label">Brand Name: <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="brand_name" name="brand_name"
                                                        class="form-control maxlength-options" maxlength="40"
                                                        value="{{ $brand->brand_name }}" placeholder="Enter Your Brand Name"
                                                        required>
                                                </div>

                                                <div class="mb-4">
                                                    @php
                                                        $brand_logo = json_decode($brand->brand_logo);
                                                    @endphp
                                                    @foreach ($brand_logo as $item)
                                                        <img src="{{ asset('storage/thumb/' . $item) }}" alt="abc"
                                                            class="img-responsive"> <br>
                                                    @endforeach
                                                </div>

                                                <div class="mb-4">
                                                    <label class="col-form-label">Brand Logo: </label>
                                                    <input id="file-input" type="file" class="form-control"
                                                        name="photos[]" multiple>
                                                    <div class="form-text"><span class="text-danger">Accepts only png, jpeg,
                                                            jpg types</span></div>
                                                </div>
                                                <img id="preview" src="" alt="">

                                                <div class="text-end">
                                                    <button type="reset" class="btn btn-danger">Reset<i
                                                            class="icon-reset"></i></button>
                                                    <a href="{{ route('provider.brand.index') }}" type="submit"
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

@once
    @push('script')
        <script type="text/javascript">
            let brand_logos = $('#brand_logo').val();
        </script>
    @endpush
@endonce
