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
                <form action="{{ route('provider.product.store') }}" method="POST" class="from-prevent-multiple-submits">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Product Information</h5>
                                </div>

                                <div class="card-body">
                                    <div class="mb-4">
                                        <label class="form-label">Product Name: <span class="text-danger">*</span></label>
                                        <input type="text" id="Product_name" name="Product_name"
                                            class="form-control maxlength-options" maxlength="40"
                                            placeholder="Enter Your Product Name" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class="form-label">Category: <span
                                                        class="text-danger">*</span></label>
                                                <select name="category_id" data-placeholder="Select your category name"
                                                    class="form-control form-control-select2" required>
                                                    <option></option>
                                                    {{-- @foreach ($categorys as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row mb-3">
                                                <label class="form-label">Brand: <span class="text-danger">*</span></label>
                                                <select name="brand" data-placeholder="Select your Brand name"
                                                    class="form-control form-control-select2" required>
                                                    <option></option>
                                                    {{-- @foreach ($categorys as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach --}}
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">Unit:</label>
                                                <input type="text" id="unit" name="unit"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    placeholder="Unit (e.g. KG, Pc etc)">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">Stock Quantity:</label>
                                                <input type="text" id="stock_quantity" name="stock_quantity"
                                                    class="form-control maxlength-options" maxlength="40" placeholder="1">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Tag:</label>
                                        <select data-placeholder="Type and hit enter to add a tag"
                                            class="form-control select" id="tag" name="tag[]" multiple="multiple"
                                            data-tags="true" data-maximum-input-length="30">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Product Images</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label">Thumbnail:</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="thumbnail">
                                            <div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file
                                                size 2Mb</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label">Images Slide Show:</label>
                                        <div class="col-lg-9">
                                            <input type="file" class="form-control" name="images_slider[]" multiple>
                                            <div class="form-text text-muted">Accepted formats: gif, png, jpg. Max file
                                                size 2Mb</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Product Videos</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label class="col-lg-3 col-form-label">Video Link:</label>
                                        <div class="col-lg-9">
                                            <input type="url" class="form-control maxlength-options" maxlength="150"
                                                name="video" placeholder="Enter Your Product Video Link">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">Product Variation</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" value="Colors" disabled="">
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row mb-3">
                                                <select class="form-control multiselect" multiple="multiple"
                                                    data-include-select-all-option="true" data-enable-filtering="true"
                                                    data-enable-case-insensitive-filtering="true">
                                                    <option value="White">White</option>
                                                    <option value="Yellow">Yellow</option>
                                                    <option value="Blue">Blue</option>
                                                    <option value="Red">Red</option>
                                                    <option value="Green">Green</option>
                                                    <option value="Black">Black</option>
                                                    <option value="Brown">Brown</option>
                                                    <option value="Azure">Azure</option>
                                                    <option value="Ivory">Ivory</option>
                                                    <option value="Teal">Teal</option>
                                                    <option value="Silver">Silver</option>
                                                    <option value="Purple">Purple</option>
                                                    <option value="Navy blue">Navy blue</option>
                                                    <option value="Pea green">Pea green</option>
                                                    <option value="Gray">Gray</option>
                                                    <option value="Orange">Orange</option>
                                                    <option value="Maroon">Maroon</option>
                                                    <option value="Charcoal">Charcoal</option>
                                                    <option value="Aquamarine">Aquamarine</option>
                                                    <option value="Coral">Coral</option>
                                                    <option value="Fuchsia">Fuchsia</option>
                                                    <option value="Wheat">Wheat</option>
                                                    <option value="Lime">Lime</option>
                                                    <option value="Crimson">Crimson</option>
                                                    <option value="Khaki">Khaki</option>
                                                    <option value="Hot pink">Hot pink</option>
                                                    <option value="Magenta">Magenta</option>
                                                    <option value="Olden">Olden</option>
                                                    <option value="Plum">Plum</option>
                                                    <option value="Olive">Olive</option>
                                                    <option value="Cyan">Cyan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" value="Size" disabled="">
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row mb-3">
                                                <select class="form-control multiselect" multiple="multiple"
                                                    data-include-select-all-option="true" data-enable-filtering="true"
                                                    data-enable-case-insensitive-filtering="true">
                                                    <option value="M">M</option>
                                                    <option value="L">L</option>
                                                    <option value="XL">XL</option>
                                                    <option value="XXL">XXL</option>
                                                    <option value="S">S</option>
                                                    <option value="64GB">64GB</option>
                                                    <option value="128GB">128GB</option>
                                                    <option value="512GB">512GB</option>
                                                    <option value="1TB">1TB</option>
                                                    <option value="3/32 GB">3/32 GB</option>
                                                    <option value="4/64 GB">4/64 GB</option>
                                                    <option value="4/128 GB">4/128 GB</option>
                                                    <option value="6/128 GB">6/128 GB</option>
                                                    <option value="8/256 GB">8/256 GB</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="reset" class="btn btn-danger">Reset<i class="icon-reset"></i></button>
                        <a href="{{ route('provider.product.index') }}" type="submit" class="btn btn-info">Back</a>
                        <button type="submit" class="btn btn-primary from-prevent-multiple-submits">Submit
                            <i class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                    </div>
                </form>
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
