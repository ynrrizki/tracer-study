<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-menu-fixed " dir="ltr"
    data-theme="theme-default" {{-- data-assets-path="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/" --}} data-assets-path="{{ asset('assets') }}/"
    data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description"
        content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
    <meta name="keywords" content="tracer study pp">
    <title>Dashboard | Tracer Study</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css">
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/typeahead-js/typeahead.css" />
    {{-- <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/apex-charts/apex-charts.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.css"
        integrity="sha512-5k2n0KtbytaKmxjJVf3we8oDR34XEaWP2pibUtul47dDvz+BGAhoktxn7SJRQCHNT5aJXlxzVd45BxMDlCgtcA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dataTables/dataTables.bootstrap5.min.css') }}">

    <!-- Page CSS -->
    @stack('addon-css')

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/new-helpers.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> --}}
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style>
        .app-brand-text.demo {
            color: #091353;
            text-transform: capitalize;
            font-size: 1.25rem;
        }
    </style>
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            <!-- Navbar -->
            @include('partials.dash.navbar')
            <!-- / Navbar -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Menu -->
                    @include('partials.dash.sidebar')
                    <!-- / Menu -->

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!--/ Content -->

                    <!-- Footer -->
                    @include('partials.dash.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!--/ Content wrapper -->
            </div>

            <!--/ Layout container -->
        </div>

    </div>



    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>


    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"
        integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"
        integrity="sha512-X41/A5OSxoi5uqtS6Krhqz8QyyD8E/ZbN7B4IaBSgqPLRbWVuXJXr9UwOujstj71SoVxh5vxgy7kmtd17xrJRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/hammer/hammer.js">
    </script>
    <script src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/i18n/i18n.js">
    </script>
    <script
        src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/typeahead-js/typeahead.js">
    </script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    {{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"
        integrity="sha512-bp/xZXR0Wn5q5TgPtz7EbgZlRrIU3tsqoROPe9sLwdY6Z+0p6XRzr7/JzqQUfTSD3rWanL6WUVW7peD4zSY/vQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dataTables/dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dataTables/dataTables.bootstrap5.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('addon-js')
</body>

</html>

<!-- beautify ignore:end -->
