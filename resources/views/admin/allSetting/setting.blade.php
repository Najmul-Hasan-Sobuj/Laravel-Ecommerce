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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Search Engine Optimize</h3>
                            </div>
                            <div class="card-body">
                                <form id="formID" action="{{ route('provider.seo.update') }}" method="POST"
                                    class="from-prevent-multiple-submits">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Meta Title:</label>
                                                <input type="text" id="meta_title" name="meta_title"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$seo->meta_title }}" placeholder="Enter Meta Title">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Meta Author:</label>
                                                <input type="text" id="meta_author" name="meta_author"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$seo->meta_author }}" placeholder="Enter Meta Author">
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Meta Tag:</label>
                                                <select data-placeholder="Select Your tags" class="form-control select"
                                                    id="meta_tag" name="meta_tag[]" multiple="multiple" data-tags="true"
                                                    data-maximum-input-length="30">
                                                    @php
                                                        if (isset($seo->meta_tag)) {
                                                            $meta_tag = json_decode($seo->meta_tag);
                                                        } else {
                                                            $meta_tag = [];
                                                        }
                                                    @endphp
                                                    @if (isset($meta_tag))
                                                        @foreach ($meta_tag as $tag)
                                                            <option value="{{ $tag }}"
                                                                {{ in_array($tag, $meta_tag) ? 'selected' : '' }}>
                                                                {{ $tag }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value=""></option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Meta Description:</label>
                                                <textarea id="meta_description" name="meta_description" rows="4" cols="3" maxlength="225"
                                                    class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->meta_description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Google Adsense:</label>
                                                <textarea id="google_adsense_" name="google_adsense_" rows="4" cols="3" maxlength="225"
                                                    class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->google_adsense_ }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Google Analytics:</label>
                                                <textarea id="google_analytics" name="google_analytics" rows="4" cols="3" maxlength="225"
                                                    class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->google_analytics }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">Google Verification:</label>
                                                <input type="text" id="google_verification" name="google_verification"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$seo->google_verification }}"
                                                    placeholder="Enter Google Verification">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">Alexa Verification:</label>
                                                <input type="text" id="alexa_verification" name="alexa_verification"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$seo->alexa_verification }}"
                                                    placeholder="Enter Alexa Verification">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary from-prevent-multiple-submits submits">Submit<i
                                                class="ph-paper-plane-tilt ms-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Simple Mail Transfer Protocol</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('provider.smtp.update') }}" method="POST"
                                    class="from-prevent-multiple-submits">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Mailer:</label>
                                                <input type="text" id="mailer" name="mailer"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$smtp->mailer }}" placeholder="Enter Mailer">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Host:</label>
                                                <input type="text" id="host" name="host"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$smtp->host }}" placeholder="Enter Host">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Port:</label>
                                                <input type="text" id="port" name="port"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$smtp->port }}" placeholder="Enter port">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">User Name:</label>
                                                <input type="text" id="user_name" name="user_name"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$smtp->user_name }}" placeholder="Enter User Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-4">
                                                <label class="form-label">Password:</label>
                                                <input type="password" id="password" name="password"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$smtp->password }}" placeholder="Enter Password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary from-prevent-multiple-submits submits">Submit<i
                                                class="ph-paper-plane-tilt ms-2"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Website Settings</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('provider.webSetting.update') }}" method="POST"
                                    class="from-prevent-multiple-submits" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Currency:</label>
                                                <select class="form-control select" id="currency" name="currency"
                                                    data-placeholder="Select your currency"
                                                    data-minimum-results-for-search="Infinity">
                                                    <option></option>
                                                    <option value="৳"
                                                        @if (@$webSetting->phone_one == '৳') selected @endif>Taka
                                                    </option>
                                                    <option value="$"
                                                        @if (@$webSetting->phone_one == '$') selected @endif>USD</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Primary Phone Number:</label>
                                                <input type="number" id="phone_one" name="phone_one"
                                                    class="form-control maxlength-options" maxlength="11"
                                                    value="{{ @$webSetting->phone_one }}"
                                                    placeholder="Enter Your Primary Phone Number">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Secondary Phone Number:</label>
                                                <input type="number" id="phone_two" name="phone_two"
                                                    class="form-control maxlength-options" maxlength="11"
                                                    value="{{ @$webSetting->phone_two }}"
                                                    placeholder="Enter Your Secondary Phone Number">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="mb-4">
                                                <label class="form-label">Primary Email Address:</label>
                                                <input type="email" id="main_email" name="main_email"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->main_email }}"
                                                    placeholder="Enter Primary mail Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-4">
                                                <label class="form-label">Secondary Email Address:</label>
                                                <input type="email" id="support_email" name="support_email"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->support_email }}"
                                                    placeholder="Enter Secondary Email Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-4">
                                                <label class="form-label">Logo:</label>
                                                <input type="file" class="form-control" name="logo">
                                                <div class="form-text"><span class="text-danger">Accepts only png, jpeg,
                                                        jpg types</span></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-4">
                                                <label class="form-label">Favicon:</label>
                                                <input type="file" class="form-control" name="favicon">
                                                <div class="form-text"><span class="text-danger">Accepts only png, jpeg,
                                                        jpg types</span></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Address:</label>
                                                <textarea id="address" name="address" rows="1" cols="4" maxlength="225"
                                                    class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Facebook:</label>
                                                <input type="url" id="facebook" name="facebook"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->facebook }}"
                                                    placeholder="https://www.facebook.com/">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Twitter:</label>
                                                <input type="url" id="twitter" name="twitter"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->twitter }}"
                                                    placeholder="https://twitter.com/">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Instagram:</label>
                                                <input type="url" id="instagram" name="instagram"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->instagram }}"
                                                    placeholder="https://www.instagram.com/">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">Linkedin:</label>
                                                <input type="url" id="linkedin" name="linkedin"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->linkedin }}"
                                                    placeholder="https://www.linkedin.com/">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-4">
                                                <label class="form-label">YouTube:</label>
                                                <input type="url" id="youtube" name="youtube"
                                                    class="form-control maxlength-options" maxlength="40"
                                                    value="{{ @$webSetting->youtube }}"
                                                    placeholder="https://www.youtube.com/">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-end">
                                        <button type="submit"
                                            class="btn btn-primary from-prevent-multiple-submits submits">Submit<i
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


@push('script')
    <script type="text/javascript">
        $(function seo() {
            $('.submits').attr('disabled', true);
            $(":input").on("keyup change", function(e) {
                if ($('#meta_title').val() != '' || $('#meta_author').val() != '' || $('#meta_tag')
                    .val() != '' || $('#meta_description').val() != '' || $('#google_verification').val() !=
                    '' || $('#google_analytics').val() != '' || $('#alexa_verification').val() != '' || $(
                        '#google_adsense_').val() != '') {
                    $('.submits').attr('disabled', false);
                } else {
                    $('.submits').attr('disabled', true);
                }
            });

        });

        // 
        $(function smtp() {
            $('.submits').attr('disabled', true);
            $(":input").on("keyup change", function(e) {
                if ($('#mailer').val() != '' || $('#host').val() != '' || $('#port')
                    .val() != '' || $('#user_name').val() != '' || $('#password').val() != '') {
                    $('.submits').attr('disabled', false);
                } else {
                    $('.submits').attr('disabled', true);
                }
            });

        });
    </script>
@endpush
