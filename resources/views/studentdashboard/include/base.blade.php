<!DOCTYPE html>
<html lang="en" dir="ltr">


<!-- Mirrored from educate.frontted.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2024 09:02:00 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>

    <!-- Prevent the demo from appearing in search engines -->
    <meta name="robots" content="noindex">

    <!-- Perfect Scrollbar -->
    <link type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar.css') }}" rel="stylesheet">

    <!-- App CSS -->
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/app.rtl.css') }}" rel="stylesheet">

    <!-- Material Design Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-material-icons.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-material-icons.rtl.css') }}" rel="stylesheet">

    <!-- Font Awesome FREE Icons -->
    <link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-fontawesome-free.rtl.css') }}" rel="stylesheet">

    <!-- ion Range Slider -->
    <link type="text/css" href="{{ asset('assets/css/vendor-ion-rangeslider.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-ion-rangeslider.rtl.css') }}" rel="stylesheet">
    


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115115077-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-115115077-4');
    </script>



    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            '../connect.facebook.net/en_US/fbevents.js');
        fbq('init', '340571383230227');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=340571383230227&amp;ev=PageView&amp;noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->




    <!-- Flatpickr -->
    <link type="text/css" href="{{ asset('assets/css/vendor-flatpickr.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-flatpickr.rtl.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-flatpickr-airbnb.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets/css/vendor-flatpickr-airbnb.rtl.css') }}" rel="stylesheet">

    <!-- Vector Maps -->
    <link type="text/css" href="{{ asset('assets/vendor/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

        {{-- tailwind --}}
        <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="layout-default">

    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px" data-fullbleed>
        <div class="mdk-drawer-layout__content">

            <!-- Header Layout -->
            <div class="mdk-header-layout js-mdk-header-layout " >

                <!-- Header -->

                <div id="header" class="mdk-header js-mdk-header m-0" data-fixed data-effects="waterfall"
                    data-retarget-mouse-scroll="false">
                    <div class="mdk-header__content">

                        <div class="navbar navbar-expand-sm navbar-main navbar-dark  pl-md-0 pr-0" style="background-color: darkgreen" id="navbar"
                            data-primary>
                            <div class="container-fluid page__container pr-0">

                                <!-- Navbar toggler -->
                                <button class="navbar-toggler navbar-toggler-custom  d-lg-none d-flex mr-navbar"
                                    type="button" data-toggle="sidebar">
                                    <span class="material-icons icon-14pt">menu</span>
                                </button>




                               



                                <form class="ml-auto search-form search-form--light d-none d-sm-flex flex"
                                    action="https://educate.frontted.com/index.html">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button class="btn" type="submit"><i class="material-icons">search</i></button>
                                </form>


                                <ul class="nav navbar-nav d-none d-md-flex">
                                    <li class="nav-item dropdown">
                                        <a href="#notifications_menu" class="nav-link dropdown-toggle"
                                            data-toggle="dropdown" data-caret="false">
                                            <i
                                                class="material-icons nav-icon navbar-notifications-indicator">notifications</i>
                                        </a>
                                        <div id="notifications_menu"
                                            class="dropdown-menu dropdown-menu-right navbar-notifications-menu">
                                            <div class="dropdown-item d-flex align-items-center py-2">
                                                <span
                                                    class="flex navbar-notifications-menu__title m-0">Notifications</span>
                                                <a href="javascript:void(0)" class="text-muted"><small>Clear
                                                        all</small></a>
                                            </div>
                                            <div class="navbar-notifications-menu__content" data-perfect-scrollbar>
                                                <div class="py-2">

                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <div class="avatar avatar-xs">
                                                                <img src="{{ asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg') }}"
                                                                    alt="Avatar" class="avatar-img rounded-circle">
                                                            </div>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#">A.Demian</a> left a comment on <a
                                                                href="#">Stack</a><br>
                                                            <small class="text-muted">1 minute ago</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <a href="#">
                                                                <div class="avatar avatar-xs">
                                                                    <span
                                                                        class="avatar-title bg-primary rounded-circle"><i
                                                                            class="material-icons icon-16pt">person_add</i></span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            New user <a href="#">Peter Parker</a> signed up.<br>
                                                            <small class="text-muted">1 hour ago</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <a href="#">
                                                                <div class="avatar avatar-xs">
                                                                    <span class="avatar-title rounded-circle">JD</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#">Big Joe</a> <small
                                                                class="text-muted">wrote:</small><br>
                                                            <div>Hey, how are you? What about our next meeting</div>
                                                            <small class="text-muted">2 minutes ago</small>
                                                        </div>
                                                    </div>

                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <div class="avatar avatar-xs">
                                                                <img src="{{ asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg') }}"
                                                                    alt="Avatar" class="avatar-img rounded-circle">
                                                            </div>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#">A.Demian</a> left a comment on <a
                                                                href="#">Stack</a><br>
                                                            <small class="text-muted">1 minute ago</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <a href="#">
                                                                <div class="avatar avatar-xs">
                                                                    <span
                                                                        class="avatar-title bg-primary rounded-circle"><i
                                                                            class="material-icons icon-16pt">person_add</i></span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            New user <a href="#">Peter Parker</a> signed up.<br>
                                                            <small class="text-muted">1 hour ago</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <a href="#">
                                                                <div class="avatar avatar-xs">
                                                                    <span class="avatar-title rounded-circle">JD</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#">Big Joe</a> <small
                                                                class="text-muted">wrote:</small><br>
                                                            <div>Hey, how are you? What about our next meeting</div>
                                                            <small class="text-muted">2 minutes ago</small>
                                                        </div>
                                                    </div>

                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <div class="avatar avatar-xs">
                                                                <img src="{{ asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg') }}"
                                                                    alt="Avatar" class="avatar-img rounded-circle">
                                                            </div>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#">A.Demian</a> left a comment on <a
                                                                href="#">Stack</a><br>
                                                            <small class="text-muted">1 minute ago</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <a href="#">
                                                                <div class="avatar avatar-xs">
                                                                    <span
                                                                        class="avatar-title bg-primary rounded-circle"><i
                                                                            class="material-icons icon-16pt">person_add</i></span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            New user <a href="#">Peter Parker</a> signed up.<br>
                                                            <small class="text-muted">1 hour ago</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-item d-flex">
                                                        <div class="mr-3">
                                                            <a href="#">
                                                                <div class="avatar avatar-xs">
                                                                    <span class="avatar-title rounded-circle">JD</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="flex">
                                                            <a href="#">Big Joe</a> <small
                                                                class="text-muted">wrote:</small><br>
                                                            <div>Hey, how are you? What about our next meeting</div>
                                                            <small class="text-muted">2 minutes ago</small>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <a href="javascript:void(0);"
                                                class="dropdown-item text-center navbar-notifications-menu__footer">View
                                                All</a>
                                        </div>
                                    </li>
                                
                                </ul>

                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" data-caret="false"
                                        class="dropdown-toggle navbar-toggler navbar-toggler-dashboard border-left d-flex align-items-center ml-navbar">
                                        <span class="material-icons">laptop</span> My Dashboard
                                    </a>
                                    <div id="company_menu"
                                        class="dropdown-menu dropdown-menu-right navbar-company-menu">
                                        <div
                                            class="dropdown-item d-flex align-items-center py-2 navbar-company-info py-3">

                                            <span class="mr-3">
                                                <img src="{{ asset('assets/images/frontted-logo-blue.svg') }}"
                                                    width="43" height="43" alt="avatar">
                                            </span>
                                            <span class="flex d-flex flex-column">
                                                <strong class="h5 m-0">Adrian D.</strong>
                                                <small class="text-muted text-uppercase">STUDENT</small>
                                            </span>

                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item d-flex align-items-center py-2"
                                            href="edit-account.html">
                                            <span class="material-icons mr-2">account_circle</span> Edit Account
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="#">
                                            <span class="material-icons mr-2">settings</span> Settings
                                        </a>
                                        <a class="dropdown-item d-flex align-items-center py-2" href="login.html">
                                            <span class="material-icons mr-2">exit_to_app</span> Logout
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <!-- // END Header -->

                @section('content')

                @show

            </div>
            <!-- // END header-layout -->

        </div>
        <!-- // END drawer-layout__content -->

        @include('studentDashboard.include.sidebar')
    </div>
    <!-- // END drawer-layout -->

    <div class="mdk-drawer js-mdk-drawer" id="events-drawer" data-align="end">
        <div class="mdk-drawer__content">
            <div class="sidebar sidebar-light sidebar-left" data-perfect-scrollbar>




                <small class="text-dark-gray px-3 py-1">
                    <strong>Thursday, 28 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>12:30 PM</small>
                                <small class="text-dark-gray">2 hrs</small>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Marketing Team
                                            Meeting</strong></a>

                                    <small class="text-muted d-flex align-items-center"><i
                                            class="material-icons icon-16pt mr-1">location_on</i> 16845 Hicks
                                        Road</small>


                                </div>
                                <div class="avatar-group mt-2">

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/256_joao-silas-636453-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/256_jeremy-banks-798787-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/256_daniel-gaffey-1060698-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <small class="text-dark-gray px-3 py-1">
                    <strong>Wednesday, 27 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>07:48 PM</small>
                                <small class="text-dark-gray">30 min</small>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Call
                                            Alex</strong></a>


                                    <small class="text-muted d-flex align-items-center"><i
                                            class="material-icons icon-16pt mr-1">phone</i> 202-555-0131</small>

                                </div>



                            </div>
                        </div>
                    </div>

                </div>

                <small class="text-dark-gray px-3 py-1">
                    <strong>Tuesday, 26 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>03:13 PM</small>
                                <small class="text-dark-gray">2 hrs</small>
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Design Team
                                            Meeting</strong></a>

                                    <small class="text-muted d-flex align-items-center"><i
                                            class="material-icons icon-16pt mr-1">location_on</i> 16845 Hicks
                                        Road</small>


                                </div>
                                <div class="avatar-group mt-2">

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/256_rsz_1andy-lee-642320-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/256_michael-dam-258165-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/256_luke-porter-261779-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                    <div class="avatar avatar-xs">
                                        <img src="{{ asset('assets/images/stories/256_rsz_clem-onojeghuo-193397-unsplash.jpg') }}"
                                            alt="Avatar" class="avatar-img rounded-circle">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <small class="text-dark-gray px-3 py-1">
                    <strong>Monday, 25 Feb</strong>
                </small>

                <div class="list-group list-group-flush">

                    <div class="list-group-item bg-light">
                        <div class="row">
                            <div class="col-auto d-flex flex-column">
                                <small>12:30 PM</small>
                                <small class="text-dark-gray">2 hrs</small>
                            </div>
                            <div class="col d-flex">
                                <div class="d-flex flex-column flex">
                                    <a href="#" class="text-body"><strong class="text-15pt">Call
                                            Wendy</strong></a>


                                    <small class="text-muted d-flex align-items-center"><i
                                            class="material-icons icon-16pt mr-1">phone</i> 202-555-0131</small>

                                </div>


                                <div class="avatar avatar-xs">
                                    <img src="{{ asset('assets/images/256_michael-dam-258165-unsplash.jpg') }}"
                                        alt="Avatar" class="avatar-img rounded-circle">
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



    @yield('scripts')
{{-- 
    <!-- App Settings FAB -->
    <div id="app-settings">
        <app-settings layout-active="default" :layout-location="{
      'default': 'index.html',
      'fixed': 'fixed-index.html',
      'fluid': 'fluid-index.html',
      'mini': 'mini-index.html'
    }"></app-settings>
    </div> --}}

    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('assets/vendor/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap.min.js') }}"></script>

    <!-- Perfect Scrollbar -->
    <script src="{{ asset('assets/vendor/perfect-scrollbar.min.js') }}"></script>

    <!-- DOM Factory -->
    <script src="{{ asset('assets/vendor/dom-factory.js') }}"></script>

    <!-- MDK -->
    <script src="{{ asset('assets/vendor/material-design-kit.js') }}"></script>

    <!-- Range Slider -->
    <script src="{{ asset('assets/vendor/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/js/ion-rangeslider.js') }}"></script>

    <!-- App -->
    <script src="{{ asset('assets/js/toggle-check-all.js') }}"></script>
    <script src="{{ asset('assets/js/check-selected-row.js') }}"></script>
    <script src="{{ asset('assets/js/dropdown.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-mini.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- App Settings (safe to remove) -->
    <script src="{{ asset('assets/js/app-settings.js') }}"></script>


    <!-- Flatpickr -->
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>

    <!-- Global Settings -->
    <script src="{{ asset('assets/js/settings.js') }}"></script>

    <!-- Moment.js')}} -->
    <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/moment-range.js') }}"></script>


    <!-- Chart.js')}} -->
    <script src="{{ asset('assets/vendor/Chart.min.js') }}"></script>

    <!-- App Charts JS -->
    <script src="{{ asset('assets/js/chartjs-rounded-bar.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script>

    <!-- Chart Samples -->
    <script src="{{ asset('assets/js/page.analytics.js') }}"></script>


</body>


<!-- Mirrored from educate.frontted.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2024 09:02:00 GMT -->

</html>