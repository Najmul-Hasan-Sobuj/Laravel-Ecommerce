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
                                <h3>Search Engine Optimize</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('provider.seo.update') }}" method="POST"
                                    class="from-prevent-multiple-submits">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="form-label">Meta Title:</label>
                                        <input type="text" id="meta_title" name="meta_title"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$seo->meta_title }}" placeholder="Enter Meta Title">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Meta Author:</label>
                                        <input type="text" id="meta_author" name="meta_author"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$seo->meta_author }}" placeholder="Enter Meta Author">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Meta Tag:</label>
                                        <select data-placeholder="Select Your tags" class="form-control select"
                                            id="meta_tag" name="meta_tag[]" multiple="multiple" data-tags="true"
                                            data-maximum-input-length="30">
                                            @php
                                                $meta_tag = json_decode($seo->meta_tag);
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
                                    <div class="mb-4">
                                        <label class="form-label">Meta Description:</label>
                                        <textarea id="meta_description" name="meta_description" rows="3" cols="3" maxlength="225"
                                            class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->meta_description }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Google Verification:</label>
                                        <input type="text" id="google_verification" name="google_verification"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$seo->google_verification }}"
                                            placeholder="Enter Google Verification">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Google Analytics:</label>
                                        <textarea id="google_analytics" name="google_analytics" rows="3" cols="3" maxlength="225"
                                            class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->google_analytics }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Google Adsense:</label>
                                        <textarea id="google_adsense_" name="google_adsense_" rows="3" cols="3" maxlength="225"
                                            class="form-control maxlength-textarea" placeholder="This textarea has a limit of 225 chars.">{{ @$seo->google_adsense_ }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Alexa Verification:</label>
                                        <input type="text" id="alexa_verification" name="alexa_verification"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$seo->alexa_verification }}" placeholder="Enter Alexa Verification">
                                    </div>

                                    <div class="text-end">
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
                                <h3>Simple Mail Transfer Protocol</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('provider.smtp.update') }}" method="POST"
                                    class="from-prevent-multiple-submits">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="form-label">Mailer:</label>
                                        <input type="text" id="mailer" name="mailer"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$smtp->mailer }}" placeholder="Enter Mailer">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Host:</label>
                                        <input type="text" id="host" name="host"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$smtp->host }}" placeholder="Enter Host">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Port:</label>
                                        <input type="text" id="port" name="port"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$smtp->port }}" placeholder="Enter port">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">User Name:</label>
                                        <input type="text" id="user_name" name="user_name"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$smtp->user_name }}" placeholder="Enter User Name">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password:</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control maxlength-options" maxlength="40"
                                            value="{{ @$smtp->password }}" placeholder="Enter Password">
                                    </div>

                                    <div class="text-end">
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
