@extends('layouts.auth')

@section('title')
    Login Alumni | Tracer Study
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row h-screen items-center">
        <!-- Bagian kiri -->
        <div class="bg-primary-50 hidden lg:flex justify-center items-center w-full lg:w-1/2 xl:w-2/3 h-screen">
            <img class="w-2/3" src="{{ asset('assets/img/illustrations/Graduation-bro.svg') }}">
        </div>

        <!-- Bagian kanan -->
        <div class="bg-white w-full lg:w-1/2 xl:w-1/3 h-screen lg:h-auto flex items-center lg:px-7 sm:px-32">
            <div data-aos="fade-up" class="p-16 sm:p-0 lg:p-20 xl:p-20 w-full">
                <!-- Header -->
                <div class="flex justify-center items-center mb-8">
                    <img class="h-20 w-20
                    " src="{{ asset('assets/logo/logo.png') }}" alt="">
                    <div class="flex flex-col">
                        <h1 class="text-3xl text-secondary font-bold">Tracer Study</h1>
                        <h1 class="text-3xl text-primary font-bold">Prestasi Prima</h1>
                    </div>
                </div>
                <form action="{{ route('auth.login') }} " method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nik" class="label">NIK</label>
                        <input type="text" id="nik" name="nik" placeholder="Masukkan NIK Anda"
                            class="form-control focus:shadow-outline">
                    </div>
                    <div class="mt-6 mb-4">
                        <label class="label">
                            <span>Google RECAPTCHA</span>
                        </label>

                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="mb-8">
                        <label for="remember" class="inline-flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="form-checkbox  text-primary-600">
                            <span class="ml-2 text-gray-600">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-full mb-4">Masuk</button>
                    <a href="/" class="btn btn-outline-secondary w-full">Kembali</a>
                </form>
                <hr class="my-8">
                {{-- <p class="mt-8">Belum punya akun? <a href="#"
                        class="text-indigo-600 font-bold hover:text-indigo-800">Daftar Sekarang</a></p> --}}
            </div>
        </div>

    </div>

    {{-- <div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-800 to-purple-800 shadow-lg transform skew-y-0 rotate-6 rounded-3xl">
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 shadow-lg transform skew-y-0 rotate-6 rounded-3xl">
            </div>
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-md mx-auto">
                    <div>
                        <h1 class="text-2xl font-semibold">Log in to your account</h1>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                            <div class="relative">
                                <label for="email" class="font-semibold text-gray-600 block">Email address</label>
                                <input id="email" type="email" name="email"
                                    class="form-input rounded-md w-full px-3 py-2 placeholder-gray-400 text-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    placeholder="john.doe@example.com" required>
                            </div>
                            <div class="relative">
                                <label for="password" class="font-semibold text-gray-600 block">Password</label>
                                <input id="password" type="password" name="password"
                                    class="form-input rounded-md w-full px-3 py-2 placeholder-gray-400 text-gray-700 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    placeholder="********" required>
                            </div>
                            <div class="relative flex items-center">
                                <input id="remember_me" type="checkbox"
                                    class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                <label for="remember_me" class="ml-2 block text-gray-500 font-medium">Remember me</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-full">Log
                                    in</button>
                            </div>
                        </div>
                        <div class="pt-6 text-base leading-6 font-bold sm:text-lg sm:leading-7">
                            <p class="text-center">Don't have an account? <a href="#"
                                    class="text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">Sign
                                    up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <section class="gradient-form h-screen bg-primary-200">
        <div class="container h-full p-10">
            <div class="g-6 flex h-full flex-wrap items-center justify-center text-neutral-800 ">
                <div class="w-full">
                    <div class="block rounded-lg bg-white shadow-lg ">
                        <div class="g-0 lg:flex lg:flex-wrap">
                            <div class="px-4 md:px-0 lg:w-6/12">
                                <div class="md:mx-6 md:p-12">
                                    <div class="text-center">
                                        <img class="mx-auto w-20" src="{{ asset('assets/logo/logo.png') }}" alt="logo" />
                                        <h4 class="mt-1 mb-12 pb-1 text-xl font-semibold">
                                            Login Alumni Prestasi Prima
                                        </h4>
                                    </div>
                                    <form class="my-5">
                                        <p class="mb-4">Please login to your account</p>
                                        <div class="mb-4">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                                                Username
                                            </label>
                                            <input
                                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                                id="username" type="text" placeholder="Username">
                                        </div>
                                        <div class="mb-6">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                                                Password
                                            </label>
                                            <input
                                                class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                                id="password" type="password" placeholder="******************">
                                            <p class="text-red-500 text-xs italic">Please choose a password.</p>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <button
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                type="button">
                                                Sign In
                                            </button>
                                            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                                                href="#">
                                                Forgot Password?
                                            </a>
                                        </div>
                                        <div class="flex items-center justify-between pb-6">
                                            <p class="mb-0 mr-2">Don't have an account?</p>
                                            <button type="button"
                                                class="inline-block rounded border-2 border-danger px-6 pt-2 pb-[6px] text-xs font-medium uppercase leading-normal text-danger transition duration-150 ease-in-out hover:border-danger-600 hover:bg-neutral-500 hover:bg-opacity-10 hover:text-danger-600 focus:border-danger-600 focus:text-danger-600 focus:outline-none focus:ring-0 active:border-danger-700 active:text-danger-700 dark:hover:bg-neutral-100 dark:hover:bg-opacity-10"
                                                data-te-ripple-init data-te-ripple-color="light">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div
                                class="flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none bg-primary">
                                <div class="px-4 py-6 text-white md:mx-6 md:p-12">
                                    <h4 class="mb-6 text-xl font-semibold">
                                        We are more than just a company
                                    </h4>
                                    <p class="text-sm">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
