@extends('layouts.auth')

@section('title')
    Login Admin | Tracer Study
@endsection

@section('content')
    <div class="flex flex-col lg:flex-row h-screen items-center">
        <!-- Bagian kiri -->
        <div class="bg-primary-50 hidden lg:flex justify-center items-center w-full lg:w-1/2 xl:w-2/3 h-screen">
            <img data-aos="zoom-in" class="w-2/3" src="{{ asset('assets/img/illustrations/All the data-bro.svg') }}">
        </div>

        <!-- Bagian kanan -->
        <div class="bg-white w-full lg:w-1/2 xl:w-1/3 h-screen lg:h-auto flex items-center lg:px-7 sm:px-32">
            <div data-aos="fade-up" class="p-6 lg:p-10 xl:p-12 w-full">
                <!-- Header -->
                <div class="flex justify-center items-center mb-8">
                    <img class="h-20 w-20
                    " src="{{ asset('assets/logo/logo.png') }}" alt="">
                    <div class="flex flex-col">
                        <h1 class="text-3xl text-secondary font-bold">Tracer Study</h1>
                        <h1 class="text-3xl text-primary font-bold">Prestasi Prima</h1>
                    </div>
                </div>
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="label">Email</label>
                        <input type="email" id="email" name="email" placeholder="yanuarrizki165@gmail.com"
                            class="form-control focus:shadow-outline @error('email') is-invalid @enderror">
                        @error('email')
                            <label class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="label">Password</label>
                        <input type="password" id="password" name="password" placeholder="············"
                            class="form-control focus:shadow-outline @error('password') is-invalid @enderror">
                        @error('password')
                            <label class="invalid-feedback">
                                <span>{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="mb-8">
                        <label for="remember" class="inline-flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="form-checkbox text-indigo-600">
                            <span class="ml-2 text-gray-700">Remember Me</span>
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
@endsection
