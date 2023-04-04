<nav class="navbard w-full text-secondary bg-transparent absolute top-0 z-40 pt-2 ease-in duration-500">
    <div class="container mx-auto px-4 lg:max-w-7xl flex justify-between">
        <div class="flex flex-row gap-1 items-center py-3 md:py-2">
            <a href="/" class="flex items-center" aria-label="Go to home">
                <img class="h-14 sm:h-16 transition-all ease-out duration-1000" src="{{ asset('assets/logo.png') }}"
                    alt="Prestasi Prima">
                <span class="hidden md:block text-xl font-bold ml-2">Sekolah Prestasi Prima</span>
            </a>

        </div>
        <div class="flex items-center gap-3 ml-6">
            @auth
                <ul class="menu menu-horizontal px-1">
                    <li tabindex="0">
                        <a>
                            {{ Str::before(auth()->user()->name, ' ') }}
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24">
                                <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                            </svg>
                        </a>
                        <ul class="p-2 bg-base-100">
                            <li><a href="{{ route('home') }}">Beranda</a></li>
                            <li>
                                @if (auth()->user()->role == 'ALUMNI')
                                    <a href="{{ route('alumni') }}">Profile</a>
                                @else
                                    <a href="{{ route('admin') }}">Dashboard</a>
                                @endif
                            </li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>

                </ul>
            @else
                <a href="/"
                    class="hidden md:inline-flex items-center gap-1 px-3 py-2 rounded-lg font-bold text-primary">Beranda</a>
                <a href="#info"
                    class="hidden md:inline-flex items-center gap-1 px-3 py-2 rounded-lg font-bold text-secondary hover:text-primary">Info</a>
                <a href="#faq"
                    class="hidden md:inline-flex items-center gap-1 px-3 py-2 rounded-lg font-bold text-secondary hover:text-primary">Faq</a>
                <a href="{{ route('login') }}" class="btn btn-primary font-bold text-white">Login</a>
            @endauth

        </div>
    </div>
</nav>
