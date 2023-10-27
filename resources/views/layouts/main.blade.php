<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ERP</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    @yield('styles')
    <style>
        .btn,
        .fc button,
        .ajax-upload-dragdrop .ajax-file-upload,
        .swal2-modal .swal2-buttonswrapper .swal2-styled,
        .swal2-modal .swal2-buttonswrapper .swal2-styled.swal2-confirm,
        .swal2-modal .swal2-buttonswrapper .swal2-styled.swal2-cancel,
        .wizard>.actions a {
            font-weight: 400;
            color: black;
            text-align: center;
            font-size: 0.9375rem;
            line-height: 1;
        }

        input:disabled {
            color: #ffffff;
            /* Change the text color to gray */
            background-color: #020202;
            /* Change the background color to a light gray or any other color you prefer */
            /* Add other styles as needed */
        }
    </style>
</head>

<body @if (app()->isLocale('ar')) class="rtl" @endif>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ asset('images/' . $settings[1]->value) }}" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini" href=""><img src="{{ asset('images/' . $settings[1]->value) }}" alt="logo" /></a>
            </div>
            <ul class="nav">

                <li class="nav-item menu-items">
                    <a class="nav-link" href="/dashboard">
                        <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span>
                        <span class="menu-title">{{ __('dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic0" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">{{ __('workshop') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic0">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="/entryorexit">{{ __('maintenance') }}</a></li>
                            {{-- <li class="nav-item"> <a class="nav-link" href="">{{ __('maintenance') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="">{{ __('photos') }}</a></li> --}}
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">{{ __('product') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="/add-product">{{ __('add_product') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/products">{{ __('all_products') }}</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">{{ __('stock') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic1">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="/all-stock">{{ __('allstock') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/all-item">{{ __('allitem') }}</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">{{ __('requests') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic2">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="/add-request">{{ __('add-request') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/allrequests">{{ __('all-request') }}</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">{{ __('stocktransaction') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic3">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="/transaction">{{ __('stocktransaction') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/alltransaction">{{ __('all-stocktransaction') }}</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">{{ __('setting') }}</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic4">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('setting.index') }}">{{ __('setting') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('category.index') }}">{{ __('category') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('brand.index') }}">{{ __('brand') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('supplier.index') }}">{{ __('supplier') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('garage.index') }}">{{ __('garage') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('vehicle.index') }}">{{ __('truck') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('employee.index') }}">{{ __('employee') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('driver.index') }}">{{ __('driver') }}</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('workshop.index') }}">{{ __('workshop') }}</a></li>

                        </ul>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav w-100">
                        <li class="nav-item w-100">
                            <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                <input type="text" class="form-control" placeholder="Search products">
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">

                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdowna" href="#" data-toggle="dropdown" aria-expanded="false">
                                {{ __('language') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdowna">

                                <a href="{{ route('change_locale', 'ar') }}" class="dropdown-item preview-item">
                                    {{ __('arabic') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('change_locale', 'en') }}" class="dropdown-item preview-item">
                                    {{ __('english') }}
                                </a>

                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-email"></i>
                                <span class="count bg-success"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                                <h6 class="p-3 mb-0">Messages</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="assets/images/faces/face4.jpg" alt="image" class="rounded-circle profile-pic">
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                                        <p class="text-muted mb-0"> 1 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="assets/images/faces/face2.jpg" alt="image" class="rounded-circle profile-pic">
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                                        <p class="text-muted mb-0"> 15 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="assets/images/faces/face3.jpg" alt="image" class="rounded-circle profile-pic">
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                                        <p class="text-muted mb-0"> 18 Minutes ago </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0 text-center">4 new messages</p>
                            </div>
                        </li>
                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                <span class="count bg-danger"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-calendar text-success"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Event today</p>
                                        <p class="text-muted ellipsis mb-0"> Just a reminder that you have an event today </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Settings</p>
                                        <p class="text-muted ellipsis mb-0"> Update dashboard </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-link-variant text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">Launch Admin</p>
                                        <p class="text-muted ellipsis mb-0"> New admin wow! </p>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <p class="p-3 mb-0 text-center">See all notifications</p>
                            </div>
                        </li> --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="assets/images/faces/face15.jpg" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">

                                <div class="dropdown-divider"></div>

                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <p class="preview-subject mb-1">{{ __('Logout') }}</p>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf

                                </form>

                            </div>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div id="succ-message" style="display: none;">
                        <img src="{{ asset('success.png') }}" style="position: absolute;margin:-4rem 0 0 85rem;width:10rem" alt="">
                    </div>
                    <div id="succ-message" style="display: none;">
                        <img src="{{ asset('error.png') }}" style="position: absolute;margin:-4rem 0 0 85rem;width:10rem" alt="">
                    </div>
                    @if (session('success'))
                        <div id="success-message">
                            <img src="{{ asset('success.png') }}" style="position: absolute;margin:-4rem 0 0 85rem;width:10rem" alt="">
                        </div>
                    @endif

                    @if (session('error'))
                        <div id="error-message">
                            <img src="{{ asset('error.png') }}" style="position: absolute;margin:-4rem 0 0 85rem;width:10rem" alt="">
                        </div>
                    @endif
                    @yield('content')
                </div>

            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->
    <script>
        $(function() {
            $('.selectpicker').selectpicker();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let successMessage = document.getElementById('success-message');
            let errorMessage = document.getElementById('error-message');

            if (successMessage) {
                // Show the message and icon initially
                successMessage.style.display = 'block';

                // Set a timer to hide the message and icon after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }

                }, 1000); // Adjust the duration as needed (5 seconds in this example)
            }
            if (errorMessage) {
                // Show the message and icon initially
                errorMessage.style.display = 'block';

                // Set a timer to hide the message and icon after 5 seconds (5000 milliseconds)
                setTimeout(function() {
                    if (errorMessage) {
                        errorMessage.style.display = 'none';
                    }

                }, 1000); // Adjust the duration as needed (5 seconds in this example)
            }
        });
    </script>


    @yield('script')
</body>

</html>
