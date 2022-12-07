<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('backend/fonts/inter/inter.css" rel="stylesheet') }}" type="text/css">
    <link href="{{ asset('backend/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/icons/material/styles.min.css') }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    {{-- datatables --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> --}}
    {{-- datatables --}}

    <link href="{{ asset('backend/css/toastr.min.css') }}" rel="stylesheet" type="text/css">

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

        .form-control-feedback-icon {
            display: none;
        }
    </style>
</head>

<body>

    @guest
    @else
        <!-- Main navbar -->
        @include('admin.layouts.components.mainNavbar')
        <!-- /main navbar -->


        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

                <!-- Sidebar content -->
                <div class="sidebar-content">

                    <!-- Sidebar header -->
                    @include('admin.layouts.components.sidebarHeader')
                    <!-- /sidebar header -->

                    <!-- Main navigation -->
                    @include('admin.layouts.components.mainNavigation')

                    <!-- /main navigation -->

                </div>
                <!-- /sidebar content -->

            </div>
            <!-- /main sidebar -->

            <!-- Main content -->
            @yield('admincontent')
            <!-- /main content -->

        </div>
    @endguest

    <!-- /page content -->


    <!-- Notifications -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="notifications">
        <div class="offcanvas-header py-0">
            <h5 class="offcanvas-title py-3">Activity</h5>
            <button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill"
                data-bs-dismiss="offcanvas">
                <i class="ph-x"></i>
            </button>
        </div>

        <div class="offcanvas-body p-0">
            <div class="bg-light fw-medium py-2 px-3">New notifications</div>
            <div class="p-3">
                <div class="d-flex align-items-start mb-3">
                    <a href="#" class="status-indicator-container me-3">
                        <img src="{{ asset('backend/images/demo/users/face1.jpg') }}"
                            class="w-40px h-40px rounded-pill" alt="">
                        <span class="status-indicator bg-success"></span>
                    </a>
                    <div class="flex-fill">
                        <a href="#" class="fw-semibold">James</a> has completed the task <a href="#">Submit
                            documents</a> from <a href="#">Onboarding</a> list

                        <div class="bg-light rounded p-2 my-2">
                            <label class="form-check ms-1">
                                <input type="checkbox" class="form-check-input" checked disabled>
                                <del class="form-check-label">Submit personal documents</del>
                            </label>
                        </div>

                        <div class="fs-sm text-muted mt-1">2 hours ago</div>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <a href="#" class="status-indicator-container me-3">
                        <img src="{{ asset('backend/images/demo/users/face3.jpg') }}"
                            class="w-40px h-40px rounded-pill" alt="">
                        <span class="status-indicator bg-warning"></span>
                    </a>
                    <div class="flex-fill">
                        <a href="#" class="fw-semibold">Margo</a> has added 4 users to <span
                            class="fw-semibold">Customer enablement</span> channel

                        <div class="d-flex my-2">
                            <a href="#" class="status-indicator-container me-1">
                                <img src="{{ asset('backend/images/demo/users/face10.jpg') }}"
                                    class="w-32px h-32px rounded-pill" alt="">
                                <span class="status-indicator bg-danger"></span>
                            </a>
                            <a href="#" class="status-indicator-container me-1">
                                <img src="{{ asset('backend/images/demo/users/face11.jpg') }}"
                                    class="w-32px h-32px rounded-pill" alt="">
                                <span class="status-indicator bg-success"></span>
                            </a>
                            <a href="#" class="status-indicator-container me-1">
                                <img src="{{ asset('backend/images/demo/users/face12.jpg') }}"
                                    class="w-32px h-32px rounded-pill" alt="">
                                <span class="status-indicator bg-success"></span>
                            </a>
                            <a href="#" class="status-indicator-container me-1">
                                <img src="{{ asset('backend/images/demo/users/face13.jpg') }}"
                                    class="w-32px h-32px rounded-pill" alt="">
                                <span class="status-indicator bg-success"></span>
                            </a>
                            <button type="button"
                                class="btn btn-light btn-icon d-inline-flex align-items-center justify-content-center w-32px h-32px rounded-pill p-0">
                                <i class="ph-plus ph-sm"></i>
                            </button>
                        </div>

                        <div class="fs-sm text-muted mt-1">3 hours ago</div>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="me-3">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-pill">
                            <i class="ph-warning p-2"></i>
                        </div>
                    </div>
                    <div class="flex-1">
                        Subscription <a href="#">#466573</a> from 10.12.2021 has been cancelled. Refund case <a
                            href="#">#4492</a> created
                        <div class="fs-sm text-muted mt-1">4 hours ago</div>
                    </div>
                </div>
            </div>

            <div class="bg-light fw-medium py-2 px-3">Older notifications</div>
            <div class="p-3">
                <div class="d-flex align-items-start mb-3">
                    <a href="#" class="status-indicator-container me-3">
                        <img src="{{ asset('backend/images/demo/users/face25.jpg') }}"
                            class="w-40px h-40px rounded-pill" alt="">
                        <span class="status-indicator bg-success"></span>
                    </a>
                    <div class="flex-fill">
                        <a href="#" class="fw-semibold">Nick</a> requested your feedback and approval in support
                        request
                        <a href="#">#458</a>

                        <div class="my-2">
                            <a href="#" class="btn btn-success btn-sm me-1">
                                <i class="ph-checks ph-sm me-1"></i>
                                Approve
                            </a>
                            <a href="#" class="btn btn-light btn-sm">
                                Review
                            </a>
                        </div>

                        <div class="fs-sm text-muted mt-1">3 days ago</div>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <a href="#" class="status-indicator-container me-3">
                        <img src="{{ asset('backend/images/demo/users/face24.jpg') }}"
                            class="w-40px h-40px rounded-pill" alt="">
                        <span class="status-indicator bg-grey"></span>
                    </a>
                    <div class="flex-fill">
                        <a href="#" class="fw-semibold">Mike</a> added 1 new file(s) to <a
                            href="#">Product
                            management</a> project

                        <div class="bg-light rounded p-2 my-2">
                            <div class="d-flex align-items-center">
                                <div class="me-2">
                                    <img src="{{ asset('backend/images/icons/pdf.svg') }}" width="34"
                                        height="34" alt="">
                                </div>
                                <div class="flex-fill">
                                    new_contract.pdf
                                    <div class="fs-sm text-muted">112KB</div>
                                </div>
                                <div class="ms-2">
                                    <button type="button"
                                        class="btn btn-flat-dark text-body btn-icon btn-sm border-transparent rounded-pill">
                                        <i class="ph-arrow-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="fs-sm text-muted mt-1">1 day ago</div>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <div class="me-3">
                        <div class="bg-success bg-opacity-10 text-success rounded-pill">
                            <i class="ph-calendar-plus p-2"></i>
                        </div>
                    </div>
                    <div class="flex-fill">
                        All hands meeting will take place coming Thursday at 13:45.

                        <div class="my-2">
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="ph-calendar-plus ph-sm me-1"></i>
                                Add to calendar
                            </a>
                        </div>

                        <div class="fs-sm text-muted mt-1">2 days ago</div>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <a href="#" class="status-indicator-container me-3">
                        <img src="{{ asset('backend/images/demo/users/face4.jpg') }}"
                            class="w-40px h-40px rounded-pill" alt="">
                        <span class="status-indicator bg-danger"></span>
                    </a>
                    <div class="flex-fill">
                        <a href="#" class="fw-semibold">Christine</a> commented on your community <a
                            href="#">post</a>
                        from 10.12.2021

                        <div class="fs-sm text-muted mt-1">2 days ago</div>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <div class="me-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-pill">
                            <i class="ph-users-four p-2"></i>
                        </div>
                    </div>
                    <div class="flex-fill">
                        <span class="fw-semibold">HR department</span> requested you to complete internal survey by
                        Friday

                        <div class="fs-sm text-muted mt-1">3 days ago</div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /notifications -->


    <!-- Demo config -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
        <div class="position-absolute top-50 end-100 visible">
            <button type="button" class="btn btn-primary btn-icon translate-middle-y rounded-end-0"
                data-bs-toggle="offcanvas" data-bs-target="#demo_config">
                <i class="ph-gear"></i>
            </button>
        </div>

        <div class="offcanvas-header border-bottom py-0">
            <h5 class="offcanvas-title py-3">Demo configuration</h5>
            <button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill"
                data-bs-dismiss="offcanvas">
                <i class="ph-x"></i>
            </button>
        </div>

        <div class="offcanvas-body">
            <div class="fw-semibold mb-2">Color mode</div>
            <div class="list-group mb-3">
                <label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
                    <div class="d-flex flex-fill my-1">
                        <div class="form-check-label d-flex me-2">
                            <i class="ph-sun ph-lg me-3"></i>
                            <div>
                                <span class="fw-bold">Light theme</span>
                                <div class="fs-sm text-muted">Set light theme or reset to default</div>
                            </div>
                        </div>
                        <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme"
                            value="light" checked>
                    </div>
                </label>

                <label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
                    <div class="d-flex flex-fill my-1">
                        <div class="form-check-label d-flex me-2">
                            <i class="ph-moon ph-lg me-3"></i>
                            <div>
                                <span class="fw-bold">Dark theme</span>
                                <div class="fs-sm text-muted">Switch to dark theme</div>
                            </div>
                        </div>
                        <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme"
                            value="dark">
                    </div>
                </label>

                <label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-0">
                    <div class="d-flex flex-fill my-1">
                        <div class="form-check-label d-flex me-2">
                            <i class="ph-translate ph-lg me-3"></i>
                            <div>
                                <span class="fw-bold">Auto theme</span>
                                <div class="fs-sm text-muted">Set theme based on system mode</div>
                            </div>
                        </div>
                        <input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme"
                            value="auto">
                    </div>
                </label>
            </div>
        </div>

        <div class="border-top text-center py-2 px-3">
            <a href="https://themeforest.net/item/limitless-responsive-web-application-kit/13080328?ref=kopyov"
                class="btn btn-yellow fw-semibold w-100 my-1" target="_blank">
                <i class="ph-shopping-cart me-2"></i>
                Purchase Limitless
            </a>
        </div>
    </div>
    <!-- /demo config -->



    <!-- Core JS files -->
    <script src="{{ asset('backend/demo/demo_configurator.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{ asset('backend/js/jquery/jquery.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js" type="text/javascript"></script>

    <script src="{{ asset('backend/js/vendor/forms/selects/select2.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/forms/inputs/maxlength.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/notifications/sweet_alert.min.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/editors/ckeditor/ckeditor_classic.js') }}"></script>
    <script src="{{ asset('backend/js/vendor/forms/selects/bootstrap_multiselect.js') }}"></script>

    <script src="{{ asset('backend/js/app.js') }}"></script>

    <script src="{{ asset('backend/demo/pages/form_multiselect.js') }}"></script>
    <script src="{{ asset('backend/demo/pages/editor_ckeditor_classic.js') }}"></script>
    <script src="{{ asset('backend/demo/pages/form_select2.js') }}"></script>
    <script src="{{ asset('backend/demo/pages/extra_sweetalert.js') }}"></script>
    <script src="{{ asset('backend/demo/pages/form_controls_extended.js') }}"></script>
    <script src="{{ asset('backend/demo/pages/form_layouts.js') }}"></script>
    <script src="{{ asset('backend/demo/pages/components_buttons.js') }}"></script>

    <!-- /theme JS files -->

    <script src="{{ asset('backend/js/toastr.min.js') }}"></script>
    {!! Toastr::message() !!}

    <script src="{{ asset('backend/js/custom.js') }}"></script>
    @stack('script')
</body>

</html>
