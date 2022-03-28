<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GSG POS</title>
    {{-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('chart/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="chart/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('chart/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->

    <style>
        input[type="checkbox"] {
            /* ...existing styles */
            display: grid !important;
            place-content: center !important;
            transform: scale(2);
            background-color: #1ed085;
            margin-top: 1.2rem;
        }

        input[type="checkbox"]::before {
            content: "" !important;
            width: 0.65em !important;
            height: 0.65em !important;
            /* transform: scale(0) !important; */
            transition: 120ms transform ease-in-out !important;
            box-shadow: inset 1em 1em var(--form-control-color) !important;

        }

        input[type="checkbox"]:checked::before {
            transform: scale(1.5) !important;
            border-radius: 2px;
            background-color: #1ed085 !important;
        }

    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5" href="{{ asset('dashboard/index.html') }}">
                    Point Of Sale</a>
                <a class="navbar-brand brand-logo-mini" href="{{ asset('dashboard/index.html') }}"><img
                        src="{{ asset('dashboard/images/logo-mini.svg') }}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="icon-menu"></span>
                </button>

                <ul class="navbar-nav navbar-nav-right">

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="profileDropdown">
                            {{-- <img src="{{ asset('dashboard/images/faces/face28.jpg') }}" alt="profile" /> --}}
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="ti-settings text-primary"></i>
                                {{ __('Settings') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="ti-power-off text-primary"></i>
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>

                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="profileDropdown">
                            {{ __('language') }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                    class="dropdown-item">

                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </li>

                </ul>

            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="icon-grid menu-icon"></i>
                            <span class="menu-title">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="icon-layout menu-icon"></i>
                            <span class="menu-title">{{ __('Definition') }}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('definition.index') }}">{{ __('Clients') }}</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('products.index') }}">{{ __('Products') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <i class="icon-file menu-icon"></i>
                            <span class="menu-title">{{ __('Invoices') }}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('buying.index') }}">
                                        {{ __('Purchase Invoices') }}</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('sales.create') }}">
                                        {{ __('Sales Invoices') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false"
                            aria-controls="charts">
                            <i class="icon-paper menu-icon"></i>
                            <span class="menu-title">{{ __('Reports') }}</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('reports-sale.index') }}">{{ __('Sales Report') }}
                                    </a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('reports-customer.index') }}">{{ __('Customer Report') }}</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('reports-supplier.index') }}">{{ __('Supplier Report') }}</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('reports-products.index') }}">{{ __('Products Report') }}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('receipt.index') }}">
                            <i class="icon-file menu-icon"></i>
                            <span class="menu-title">{{ __('Debentures') }}</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper" style="margin-left: 0!important">
                    {{-- content --}}
                    @include('sweetalert::alert')
                    @yield('content')
                </div>
            </div>


            <!-- plugins:js -->
            <script src="{{ asset('dashboard/vendors/js/vendor.bundle.base.js') }}"></script>
            <!-- endinject -->
            <!-- Plugin js for this page -->
            <script src="{{ asset('dashboard/vendors/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('dashboard/vendors/datatables.net/jquery.dataTables.js') }}"></script>
            <script src="{{ asset('dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
            <script src="{{ asset('dashboard/js/dataTables.select.min.js') }}"></script>

            <!-- End plugin js for this page -->
            <!-- inject:js -->
            <script src="{{ asset('dashboard/js/off-canvas.js') }}"></script>
            <script src="{{ asset('dashboard/js/hoverable-collapse.js') }}"></script>
            <script src="{{ asset('dashboard/js/template.js') }}"></script>
            <script src="{{ asset('dashboard/js/settings.js') }}"></script>
            <script src="{{ asset('dashboard/js/todolist.js') }}"></script>
            <!-- endinject -->
            <!-- Custom js for this page-->
            <script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
            <script src="{{ asset('dashboard/js/Chart.roundedBarCharts.js') }}"></script>
            <!-- End custom js for this page-->
</body>

</html>
