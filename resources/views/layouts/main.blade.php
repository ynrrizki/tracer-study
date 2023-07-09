<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">

    <title>Tracer Study Prestasi Prima</title>

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

    <!-- Vendor -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    {{-- <link id="EmbedSocialIFrameLightboxCSS" rel="stylesheet"
        href="https://embedsocial.com/cdn/iframe-lightbox.min.css?v=2.0"> --}}
    {{-- <link id="EmbedSocialNewPopupCSS" rel="stylesheet" href="https://embedsocial.com/cdn/universal-popup.css"> --}}
    {{-- <link rel="stylesheet" href="sweetalert2.min.css"> --}}
    {{-- <link rel="stylesheet"
        href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/vendor/libs/flatpickr/flatpickr.css"> --}}

    <!-- Style -->
    @vite('resources/css/app.css')
    @stack('addon-css')
    <style>
        body.preloader-site {
            overflow: hidden;
        }

        .preloader-wrapper {
            background-color: white;
            height: 100vh;
            /* Set the height to 100% of the viewport height */
            width: 100%;
            /* Set the width to 100% */
            display: flex;
            /* Use flexbox to center the preloader */
            align-items: center;
            /* Center vertically */
            justify-content: center;
            /* Center horizontally */
            position: fixed;
            z-index: 9999999;
        }

        .preloader-wrapper .preloader {
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/custom-flatpickr.css') }}">
</head>

<body class="font-sans {{ $bgBody ?? '' }}">
    <div class="preloader-wrapper">
        <div class="preloader">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin fill-primary" viewBox="0 0 100 101"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
        </div>
    </div>

    <!-- Navbar Section -->
    @include('partials.navbar', ['using' => $isNavbar ?? true])
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer', ['using' => $isFooter ?? true])


    <!-- Vendor -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(window).on("load", function() {
            $(".preloader-wrapper").fadeOut(1000);
        });

        // Show/hide the modal
        $('[data-modal-toggle]').on('click', function() {
            var target = $(this).data('modal-target');
            $('#' + target).removeClass('hidden');
            $('#login-modal').fadeIn();
            $('#' + target).addClass('flex justify-center mt-10');
            $('body').addClass('overflow-hidden');
        });

        $('[data-modal-hide]').on('click', function() {
            var target = $(this).data('modal-hide');
            $('#' + target).addClass('hidden');
            $('#login-modal').fadeOut();
            $('body').removeClass('overflow-hidden');
        });

        // Close the modal when pressing the ESC key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) {
                $('[data-modal-hide]').trigger('click');
            }
        });
    </script>

    <script>
        $(".form-date").flatpickr({
            // monthSelectorType: "static",
        });

        AOS.init({
            once: true,
        });
        AOS.refreshHard(); // initialize AOS animations
    </script>
    {{-- <script id="EmbedSocialIFrame" src="https://embedsocial.com/cdn/iframe.js"></script> --}}
    {{-- <script id="EmbedSocialNewPopup" src="https://embedsocial.com/cdn/universal-popup.js"></script> --}}
    @stack('addon-js')
</body>

</html>
