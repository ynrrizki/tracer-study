<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&family=Poppins:wght@700&display=swap"
        rel="stylesheet">

    <title>Tracer Study</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/logo.png">
    <link rel="icon" type="image/png" href="assets/logo.png">
    @vite('resources/css/app.css')
    @stack('addon-css')
</head>

<body class="font-sans">
    {{-- navbar --}}
    @include('partials.navbar')

    @yield('content')

    @stack('addon-js')
    <script>
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
</body>

</html>
