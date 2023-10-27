<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="img/fav.png" />

    <!-- Title -->
    <title>ERP</title>


    <!-- *************
   ************ Common Css Files *************
  ************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/daterange.css') }}" />

    @yield('styles')
</head>

<body>
    <div class="container-fluid">


        <!-- Navigation start -->
        <nav class="navbar navbar-expand-lg custom-navbar">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#WafiAdminNavbar" aria-controls="WafiAdminNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="WafiAdminNavbar">
                <ul class="navbar-nav">

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/entryorexit" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('workshop') }}</button>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/products" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('all_products') }}</button>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/add-product" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('add_product') }}</button>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/all-stock" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('allstock') }}</button>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/all-item" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('allitem') }}</button>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/add-request" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('add-request') }}</button>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/allrequests" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('all-request') }}</button>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="/transaction" role="button">
                            <button class="btn btn-success" style="width: 100%;">{{ __('stocktransaction') }}</button>
                        </a>
                    </li>



                </ul>
            </div>
            <div class="header-items">


                <ul class="header-actions">
                    <li class="dropdown">
                        <a href="#" id="notifications" data-toggle="dropdown" aria-haspopup="true">
                            <i class="icon-box"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right lrg" aria-labelledby="notifications">

                            <ul class="header-tasks">
                                <li>
                                    <a class="dropdown-item" href="{{ route('change_locale', 'ar') }}">arabic</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('change_locale', 'en') }}">english</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                            <span class="user-name">Sadek khmiri</span>
                            <span class="avatar">SD<span class="status busy"></span></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userSettings">
                            <div class="header-profile-actions">
                                <div class="header-user-profile">
                                    <div class="header-user">

                                    </div>
                                    <h5>sadek</h5>
                                    <p>Admin</p>
                                </div>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    <i class="icon-log-out1"></i></a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf

                                </form>

                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#" class="quick-settings-btn" data-toggle="tooltip" data-placement="left" title="" data-original-title="Quick Settings">
                            <i class="icon-list"></i>
                        </a>
                    </li>
                </ul>
                <!-- Header actions end -->
            </div>
        </nav>
        <!-- Navigation end -->


        <!-- *************
    ************ Main container start *************
   ************* -->
        <div class="main-container">

            <div class="content-wrapper" @if (app()->isLocale('ar')) dir="rtl" style="text-align:right" @endif>
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
            <!-- Content wrapper end -->


        </div>
        <!-- *************
    ************ Main container end *************
   ************* -->


        <!-- Footer start -->
        <footer class="main-footer">© developped by SDK</footer>
        <!-- Footer end -->


    </div>

    <!-- Loading starts -->

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/custom-scrollbar.js') }}"></script>
    <script src="{{ asset('js/daterange.js') }}"></script>
    <script src="{{ asset('js/custom-daterange.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
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
