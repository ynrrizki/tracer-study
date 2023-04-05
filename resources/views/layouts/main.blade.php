<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <!-- Style -->
    @vite('resources/css/app.css')
    @stack('addon-css')
</head>

<body class="font-sans {{ $bgBody ?? '' }}">
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
    <script>
        // Show/hide the modal
        $('[data-modal-toggle]').on('click', function() {
            var target = $(this).data('modal-target');
            $('#' + target).removeClass('hidden');
            $('#crypto-modal').fadeIn();
            $('#' + target).addClass('flex justify-center mt-10');
            $('body').addClass('overflow-hidden');
        });

        $('[data-modal-hide]').on('click', function() {
            var target = $(this).data('modal-hide');
            $('#' + target).addClass('hidden');
            $('#crypto-modal').fadeOut();
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
        AOS.init({
            once: true,
        });
        AOS.refreshHard(); // initialize AOS animations

        // bg-white sticky shadow-md
        window.addEventListener("scroll", function() {
            var nav = document.querySelector("nav");
            var shouldToggle = window.scrollY > 0;
            nav.classList.toggle('fixed', shouldToggle);
            nav.classList.toggle('bg-white', shouldToggle);
            nav.classList.toggle('shadow-md', shouldToggle);

            if (window.scrollY === 0) {
                nav.classList.add('bg-transparent', 'absolute');
            } else {
                nav.classList.remove('bg-transparent', 'absolute');
            }
        });
    </script>
    @stack('addon-js')
</body>

</html>
