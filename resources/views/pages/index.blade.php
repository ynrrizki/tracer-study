@extends('layouts.main')

@section('content')
    <!-- Hero -->
    <section class="relative pb-32">
        <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-32 lg:mt-40">
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start" data-aos="fade-down">
                <h2
                    class="text-secondary font-bold tracking-tighter leading-tight whitespace-nowrap text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                    Tracer Study <br>
                    <span class="text-primary">Prestasi Prima</span>
                </h2>
                <p class="text-secondary text-lg text-center lg:text-left mb-6">
                    Daftar Sekarang untuk Mengikuti Tracer Study dan Mulai Membangun Masa Depan Karirmu yang
                    Cemerlang!
                </p>
                <div class="flex justify-center flex-wrap gap-6">
                    <a href="#" class="btn btn-primary hover:shadow-sm">
                        Isi Data Alumni
                    </a>
                    <a href="#" class="btn btn-outline-secondary hover:shadow-sm">
                        Masuk Sebagai Dudi
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
                <img data-aos="fade-left" class="w-5/6 lg:w-screen sm:w-3/6"
                    src="{{ asset('assets/img/illustrations/Mobile testing-pana.png') }}" alt="Hero Section Tracer Study">
            </div>
        </div>
    </section>
@endsection
