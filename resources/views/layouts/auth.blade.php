<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

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
    <link rel="stylesheet" href="sweetalert2.min.css">
    <!-- Style -->
    @vite('resources/css/app.css')
    <style>
        .swal2-styled.swal2-confirm:focus {
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }

        .swal2-confirm.swal2-styled {
            border-radius: 0.25rem;
            border-width: 2px;
            border-style: solid;
            --tw-border-opacity: 1;
            border-color: rgb(255 106 0 / var(--tw-border-opacity));
            --tw-bg-opacity: 1;
            background-color: rgb(255 106 0 / var(--tw-bg-opacity));
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity));
            --tw-shadow: 0 0.125rem 0.25rem 0 rgba(255, 137, 105, 0.4);
            --tw-shadow-colored: 0 0.125rem 0.25rem 0 var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
        }
    </style>
</head>

<body class="font-sans">

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    {{-- @include('partials.footer') --}}

    <!-- Vendor -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        AOS.init();
    </script>
    @if (session()->has('notif-fail'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ session('notif-fail') }}",
                showConfirmButton: true,
            })
        </script>
    @endif
</body>

</html>
