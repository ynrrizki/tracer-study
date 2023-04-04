<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&family=Poppins:wght@700&display=swap"
        rel="stylesheet">
    <title>Alumni Login</title>
    @vite('resources/css/app.css')
</head>

<body class="font-sans">
    <div class="min-h-screen bg-base-200 flex">

        <div
            class="bg-base-200 flex-1 bg-[url('https://tracervokasi.kemdikbud.go.id/img/bg_samping.png')] bg-cover bg-center">
        </div>

        <div class="bg-white lg:basis-1/3 md:basis-1/2 w-full flex justify-center items-center">

            <div class="container max-w-sm bg-white px-4">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-error shadow-lg mb-5 text-white transition-all duration-300">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Error! {{ $error }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="card-title justify-center text-primary mb-5">
                    <div class="flex items-center">
                        <img class="h-20 w-20
                        " src="{{ asset('assets/logo.png') }}"
                            alt="">
                        <div class="flex flex-col">
                            <h1 class="text-2xl text-secondary">Tracer Study</h1>
                            <h1 class="text-2xl">Prestasi Prima</h1>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>

        </div>

    </div>
    {{-- <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="card max-w-sm shadow-2xl bg-base-100">
                <div class="card-body">
                    <div class="card-title text-primary">
                        Silahkan Login
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div> --}}
</body>

</html>
