@extends('layouts.main')

@section('content')
    @push('addon-css')
        <style>
            .accordion-title .bx {
                transition: transform 0.3s ease-in-out;
            }

            .accordion-title.active .bx {
                transform: rotate(-180deg);
            }
        </style>
    @endpush
    <!-- Hero -->
    <section class="min-h-screen flex items-center" id="beranda">
        <div class="container mx-auto max-w-7xl flex flex-col-reverse lg:flex-row items-center px-5 gap-12">
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start" data-aos="fade-down">
                <h2
                    class="text-secondary font-bold tracking-tighter leading-tight whitespace-nowrap text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                    Tracer Study <br>
                    <span class="text-primary">Prestasi Prima</span>
                </h2>
                <p class="text-secondary text-lg text-center lg:text-left mb-6">
                    Tracer study, karena "where are they now?" bukan hanya pertanyaan untuk mantan pacar!
                </p>
                <div class="flex justify-center flex-wrap gap-6">
                    @auth
                        @if (auth()->user()->role == 'ALUMNI')
                            <a href="{{ route('alumni') }}" class="btn btn-primary hover:shadow-sm w-full xs:w-auto">
                                Isi Data Alumni
                            </a>
                        @endif
                        @if (auth()->user()->role == 'DUDI')
                            <a href="{{ route('dudi') }}" class="btn btn-outline-secondary hover:shadow-sm w-full xs:w-auto">
                                Masuk Sebagai Dudi
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary hover:shadow-sm w-full xs:w-auto">
                            Isi Data Alumni
                        </a>
                        <a href="{{ route('dudi.login') }}" class="btn btn-outline-secondary hover:shadow-sm w-full xs:w-auto">
                            Masuk Sebagai Dudi
                        </a>
                    @endauth

                </div>
            </div>

            <!-- Image -->
            <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
                <img data-aos="fade-left" class="w-5/6 lg:w-screen sm:w-3/6"
                    src="{{ asset('assets/img/illustrations/Mobile testing-pana.png') }}" alt="Hero Section Tracer Study">
            </div>
        </div>
    </section>
    <section class="bg-gray-100 py-16 lg:py-24" id="info">
        <div class="container mx-auto max-w-7xl px-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <!-- Image -->
                <div class="flex justify-center">
                    <img class="w-3/4 md:w-4/5 lg:w-full rounded-md" data-aos="fade-right"
                        src="{{ asset('assets/img/illustrations/Kids Studying from Home-bro.png') }}" alt="Menu Info">
                </div>

                <!-- Content -->
                <div class="flex flex-col justify-center" data-aos="fade-down">
                    <h2
                        class="text-primary font-bold whitespace-pre-line text-3xl md:text-4 lg:text-5xl text-center md:text-left mb-6">
                        Informasi Mengenai Tracer Study
                    </h2>
                    <p class="text-secondary text-lg text-justify md:text-left mb-6">
                        Tracer Study atau yang sering disebut survei alumni adalah studi mengenai lulusan lembaga
                        penyelenggara pendidikan. Hasil dari Tracer Study berupa infomasi terkait lulusan yang dapat
                        digunakan sebagai bahan evaluasi dan acuan untuk menilai mutu pendidikan dari suatu lembaga
                        pendidikan. Kedepannya, informasi ini juga dapat digunakan untuk membuat keputusan berarti terkait
                        desain studi dan solusi praktis berdasarkan hasil Tracer Study
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-white py-16 lg:pt-24 pb-60" id="faq">
        <div class="container  mx-auto max-w-7xl px-5">
            <h2
                class="text-secondary font-bold whitespace-pre-line text-3xl md:text-4 lg:text-5xl text-center md:text-left mb-6">
                FAQ Tracer Study Prestasi Prima</h2>
            <div class="grid grid-cols-1 gap-1 items-center mb-6">
                <div class="accordion border rounded">
                    <div class="accordion-item">
                        <div class="accordion-title text-base cursor-pointer px-4 py-3 flex justify-between">
                            <h3>Apa itu Tracer Study Pendidikan Vokasi</h3>
                            <i class="bx bx-chevron-down text-xl"></i>
                        </div>
                        <div class="accordion-content text-gray-500 px-4 py-2" style="display: none;">
                            <hr class="mb-5">
                            <p>
                                Tracer study pendidikan vokasi, selanjutnya disebut tracer study, merupakan survei untuk
                                mengetahui aktivitas kebekerjaan (bekerja, wirausaha dan melanjutkan pendidikan),
                                keselarasan, dan kepuasan dunia kerja terhadap lulusan pendidikan vokasi setelah satu tahun
                                lulus dari satuan pendidikan vokasi.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title text-base cursor-pointer px-4 py-3 flex justify-between">
                            <h3>Kapan Waktu Pengisian Tracer Study</h3>
                            <i class="bx bx-chevron-down text-xl"></i>
                        </div>
                        <div class="accordion-content text-gray-500 px-4 py-2" style="display: none;">
                            <hr class="mb-5">
                            <p>
                                Waktu pengisian tracer study tahun 2022 adalah mulai 5 September 2022 hingga 31 Oktober
                                2022.
                            </p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title text-base cursor-pointer px-4 py-3 flex justify-between">
                            <h3>Berapa lama waktu yang dibutuhkan untuk mengisi Tracer Study</h3><i
                                class="bx bx-chevron-down text-xl"></i>
                        </div>
                        <div class="accordion-content text-gray-500 px-4 py-2" style="display: none;">
                            <hr class="mb-5">
                            <p>Tidak lama, hanya butuh waktu beberapa menit saja untuk menyelesaikan pertanyaan-pertayaan
                                dalam tracer study.</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title text-base cursor-pointer px-4 py-3 flex justify-between">
                            <h3>Siapa saja yang ditargetkan mengisi tracer study tahun 2022?</h3><i
                                class="bx bx-chevron-down text-xl"></i>
                        </div>
                        <div class="accordion-content text-gray-500 px-4 py-2" style="display: none;">
                            <hr class="mb-5">
                            <p>Ada 3 (tiga) pihak yang menjadi sasaran tracer study tahun 2022:
                                1. Lulusan Sekolah Menengah Kejuruan tahun ajaran 2020/2021;
                                2. Satuan pendidikan SMK;
                                3. Dunia kerja (dunia usaha dunia industri), selanjutnya disebut DUDI.”</p>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title text-base cursor-pointer px-4 py-3 flex justify-between">
                            <h3>Kenapa lulusan pendidikan vokasi harus mengisi tracer study?</h3><i
                                class="bx bx-chevron-down text-xl"></i>
                        </div>
                        <div class="accordion-content text-gray-500 px-4 py-2" style="display: none;">
                            <hr class="mb-5">
                            <p>Dengan mengisi tracer study, kamu sudah berperan besar memberikan masukan untuk peningkatan
                                kualitas pendidikan vokasi di Indonesia. Masukan dari kamu sangat berharga dan akan menjadi
                                bahan evaluasi pemerintah dalam mengoptimalisasi perencanaan pelayanan pendidikan vokasi ke
                                depannya.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="bg-gray-100 py-16 lg:py-24" id="loker">
        <div class="container mx-auto max-w-7xl">
            <h2
                class="text-primary font-bold whitespace-pre-line text-3xl md:text-4 lg:text-5xl text-center md:text-left mb-6">
                Informasi Lowongan Kerja!
            </h2>
            {{-- <div class="embedsocial-hashtag" data-ref="c94591410f16824ead4670502507dba9be527bb2"> --}}
            <div class="embedsocial-hashtag" data-ref="257a5d71a7a4f4f111d19de38138fcbf7401db12">
                <a class="feed-powered-by-es feed-powered-by-es-feed-new"
                    href="https://embedsocial.com/social-media-aggregator/" target="_blank" title="Widget by EmbedSocial">
                    Widget by EmbedSocial<span>→</span> </a>
            </div>
        </div>
    </section>

    @push('addon-js')
        <script id="EmbedSocialHashtagScript" src="https://embedsocial.com/cdn/ht.js"></script>
        <script>
            window.addEventListener("scroll", function() {
                var limit = document.body.offsetHeight - window.innerHeight;
                var nav = document.querySelector("nav");
                var foot = document.querySelector("footer");
                var shouldToggleNav = window.scrollY > 0;

                nav.classList.toggle('fixed', shouldToggleNav);
                nav.classList.toggle('bg-white', shouldToggleNav);
                nav.classList.toggle('shadow-md', shouldToggleNav);

                if (window.scrollY === 0) {
                    nav.classList.add('bg-transparent', 'absolute');
                } else {
                    nav.classList.remove('bg-transparent', 'absolute');
                }
            });

            let faq = [{
                    "title": "Apa itu Tracer Study Pendidikan Vokasi",
                    "content": "Tracer study pendidikan vokasi, selanjutnya disebut tracer study, merupakan survei untuk mengetahui aktivitas kebekerjaan (bekerja, wirausaha dan melanjutkan pendidikan), keselarasan, dan kepuasan dunia kerja terhadap lulusan pendidikan vokasi setelah satu tahun lulus dari satuan pendidikan vokasi."
                },
                {
                    "title": "Kapan Waktu Pengisian Tracer Study",
                    "content": "Waktu pengisian tracer study tahun 2022 adalah mulai 5 September 2022 hingga 31 Oktober 2022."
                },
                {
                    "title": "Berapa lama waktu yang dibutuhkan untuk mengisi Tracer Study",
                    "content": "Tidak lama, hanya butuh waktu beberapa menit saja untuk menyelesaikan pertanyaan-pertayaan dalam tracer study."
                },
                {
                    "title": "Siapa saja yang ditargetkan mengisi tracer study tahun 2022?",
                    "content": "Ada 3 (tiga) pihak yang menjadi sasaran tracer study tahun 2022: \n1. Lulusan Sekolah Menengah Kejuruan tahun ajaran 2020/2021; \n2. Satuan pendidikan SMK;\n3. Dunia kerja (dunia usaha dunia industri), selanjutnya disebut DUDI.”"
                },
                {
                    "title": "Kenapa lulusan pendidikan vokasi harus mengisi tracer study?",
                    "content": "Dengan mengisi tracer study, kamu sudah berperan besar memberikan masukan untuk peningkatan kualitas pendidikan vokasi di Indonesia. Masukan dari kamu sangat berharga dan akan menjadi bahan evaluasi pemerintah dalam mengoptimalisasi perencanaan pelayanan pendidikan vokasi ke depannya."
                },
                {
                    "title": "Kenapa satuan pendidikan vokasi harus mengisi tracer study ?",
                    "content": "Dengan..."
                }
            ]



            $(document).ready(function() {
                $('.accordion-title').click(function() {
                    $('.accordion-title').not(this).removeClass('active');
                    $('.accordion-title').not(this).next('.accordion-content').slideUp();
                    $(this).toggleClass('active');
                    $(this).next('.accordion-content').slideToggle();
                });
                $(window).scroll(function() {
                    var scrollDistance = $(window).scrollTop() + 200;

                    $('section').each(function(i) {
                        if ($(this).position().top <= scrollDistance) {
                            $('.nav-item .nav-link.text-primary').removeClass('text-primary');
                            $('.nav-item .nav-link').eq(i).addClass('text-primary');
                        }
                    });
                }).scroll();
            });
        </script>
    @endpush
@endsection
