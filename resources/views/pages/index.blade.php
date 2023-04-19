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
    <section class="relative pb-32 min-h-screen py-auto" id="beranda">
        <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-32 lg:mt-40">
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start" data-aos="fade-down">
                <h2
                    class="text-secondary font-bold tracking-tighter leading-tight whitespace-nowrap text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
                    Tracer Study <br>
                    <span class="text-primary">Prestasi Prima</span>
                </h2>
                {{-- <p class="text-secondary text-lg text-center lg:text-left mb-6">
                    Daftar Sekarang untuk Mengikuti Tracer Study dan Mulai Membangun Masa Depan Karirmu yang
                    Cemerlang!
                </p> --}}
                <p class="text-secondary text-lg text-center lg:text-left mb-6">
                    Tracer study, karena "where are they now?" bukan hanya pertanyaan untuk mantan pacar!
                </p>
                <div class="flex justify-center flex-wrap gap-6">
                    @auth
                        @if (auth()->user()->role == 'ALUMNI')
                            <a href="{{ route('alumni') }}" class="btn btn-primary hover:shadow-sm">
                                Isi Data Alumni
                            </a>
                        @endif
                        @if (auth()->user()->role == 'DUDI')
                            <a href="{{ route('dudi') }}" class="btn btn-outline-secondary hover:shadow-sm">
                                Masuk Sebagai Dudi
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary hover:shadow-sm">
                            Isi Data Alumni
                        </a>
                        <a href="{{ route('dudi.login') }}" class="btn btn-outline-secondary hover:shadow-sm">
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
        <div class="container">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Image -->
                <div class="flex justify-center">
                    <img class="w-3/4 md:w-4/5 lg:w-full rounded-md" data-aos="fade-right"
                        src="{{ asset('assets/img/illustrations/Kids Studying from Home-bro.png') }}" alt="Menu Info">
                </div>

                <!-- Content -->
                <div class="flex flex-col justify-center" data-aos="fade-down">
                    <h2
                        class="text-primary font-bold tracking-tighter leading-tight whitespace-nowrap text-3xl md:text-4 lg:text-5xl text-center md:text-left mb-6">
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
        <div class="container">
            <h1 class="font-bold text-3xl mb-6 text-secondary">FAQ Tracer Study Prestasi Prima</h1>
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
                    <div class="accordion-item">
                        <div class="accordion-title text-base cursor-pointer px-4 py-3 flex justify-between">
                            <h3>Kenapa satuan pendidikan vokasi harus mengisi tracer study ?</h3><i
                                class="bx bx-chevron-down text-xl"></i>
                        </div>
                        <div class="accordion-content text-gray-500 px-4 py-2" style="display: none;">
                            <hr class="mb-5">
                            <p>Dengan...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    @push('addon-js')
        <script>
            // bg-white sticky shadow-md
            window.addEventListener("scroll", function() {
                var limit = document.body.offsetHeight - window.innerHeight;
                var nav = document.querySelector("nav");
                var foot = document.querySelector("footer");
                var shouldToggleNav = window.scrollY > 0;
                // var shouldToggleFoot = window.scrollY < window.scrollMaxY;

                nav.classList.toggle('fixed', shouldToggleNav);
                nav.classList.toggle('bg-white', shouldToggleNav);
                nav.classList.toggle('shadow-md', shouldToggleNav);

                // foot.classList.toggle('fixed', shouldToggleFoot)
                // foot.classList.toggle('bottom-0', shouldToggleFoot)
                // foot.classList.toggle('left-0', shouldToggleFoot)
                // foot.classList.toggle('z-20', shouldToggleFoot)

                if (window.scrollY === 0) {
                    nav.classList.add('bg-transparent', 'absolute');
                } else {
                    nav.classList.remove('bg-transparent', 'absolute');
                }

                // if (window.srollY === limit) {
                //     foot.classList.remove('fixed', 'bottom-0', 'left-0');
                // } else {
                //     foot.classList.add('fixed', 'bottom-0', 'left-0');
                // }
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
                // for (var i = 0; i < faq.length; i++) {
                //     var accordionItem = $('<div>').addClass('accordion-item');
                //     var accordionTitle = $('<div>').addClass(
                //         'accordion-title text-base cursor-pointer px-4 py-3 flex justify-between').appendTo(
                //         accordionItem);
                //     var accordionTitleText = $('<h3>').text(faq[i].title).appendTo(accordionTitle);
                //     var accordionIcon = $('<i>').addClass('bx bx-chevron-down text-xl').appendTo(accordionTitle);
                //     var accordionContent = $('<div>').addClass('accordion-content text-gray-500 px-4 py-2').appendTo(
                //         accordionItem);
                //     accordionContent.append('<hr class="mb-5">');
                //     var accordionContentText = $('<p>').text(faq[i].content).appendTo(accordionContent);
                //     accordionItem.appendTo('.accordion.border.rounded');
                // }


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

{{-- <div class="accordion accordion-flush" id="accordionFlushExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne" style="font-size: 16px;">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                Apa itu Tracer Study Pendidikan Vokasi
            </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample" style="">
            <div class="accordion-body">Tracer study pendidikan vokasi, selanjutnya disebut tracer study, merupakan
                survei untuk mengetahui aktivitas kebekerjaan (bekerja, wirausaha dan melanjutkan pendidikan),
                keselarasan, dan kepuasan dunia kerja terhadap lulusan pendidikan vokasi setelah satu tahun lulus dari
                satuan pendidikan vokasi.</div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseTwo" aria-expanded="true" aria-controls="flush-collapseTwo">
                Kapan Waktu Pengisian Tracer Study
            </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="flush-headingTwo"
            data-bs-parent="#accordionFlushExample" style="">
            <div class="accordion-body">Waktu pengisian tracer study tahun 2022 adalah mulai 5 September 2022 hingga 31
                Oktober 2022. </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                Berapa lama waktu yang dibutuhkan untuk mengisi Tracer Study
            </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
            data-bs-parent="#accordionFlushExample" style="">
            <div class="accordion-body">Tidak lama, hanya butuh waktu beberapa menit saja untuk menyelesaikan
                pertanyaan-pertayaan dalam tracer study. </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                Siapa saja yang ditargetkan mengisi tracer study tahun 2022?
            </button>
        </h2>
        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Ada 3 (tiga) pihak yang menjadi sasaran tracer study tahun 2022: <br>
                1. Lulusan Sekolah Menengah Kejuruan tahun ajaran 2020/2021; <br>
                2. Satuan pendidikan SMK;<br>
                3. Dunia kerja (dunia usaha dunia industri), selanjutnya disebut DUDI.” <br>

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5">
                Kenapa lulusan pendidikan vokasi harus mengisi tracer study?
            </button>
        </h2>
        <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-heading5"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Dengan mengisi tracer study, kamu sudah berperan besar memberikan masukan untuk peningkatan kualitas
                pendidikan vokasi di Indonesia. Masukan dari kamu sangat berharga dan akan menjadi bahan evaluasi
                pemerintah dalam mengoptimalisasi perencanaan pelayanan pendidikan vokasi ke depannya.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading6">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6">
                Kenapa satuan pendidikan vokasi harus mengisi tracer study ?
            </button>
        </h2>
        <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-heading6"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Dengan mengisi tracer study, setiap satuan pendidikan memberikan masukan untuk peningkatan kualitas
                pendidikan vokasi di Indonesia. Informasi dari setiap satuan pendidikan akan menjadi bahan evaluasi
                pemerintah pusat dalam mengoptimalkan perencanaan layanan pendidikan vokasi serta pemerintah provinsi
                dalam pengembangan pendidikan vokasi, khususnya SMK, di wilayahnya masing-masing.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading7">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse7" aria-expanded="false" aria-controls="flush-collapse7">
                Kenapa DUDI perlu mengisi tracer study?
            </button>
        </h2>
        <div id="flush-collapse7" class="accordion-collapse collapse" aria-labelledby="flush-heading7"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Dengan mengisi tracer study, setiap DUDI berperan besar memberikan feedback bagi peningkatan kualitas
                pendidikan vokasi di Indonesia. Informasi dari setiap DUDI akan menjadi bahan evaluasi Kemdikbudristek
                RI untuk meningkatkan relevansi pendidikan vokasi dengan kebutuhan DUDI.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading8">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse8" aria-expanded="false" aria-controls="flush-collapse8">
                Bagaimana cara lulusan pendidikan vokasi login ke tracer study ?
            </button>
        </h2>
        <div id="flush-collapse8" class="accordion-collapse collapse" aria-labelledby="flush-heading8"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Setiap lulusan pendidikan vokasi dapat login ke tracer study menggunakan Nomor Induk Siswa Nasional
                (NISN) atau Nomor Induk Kependudukan (NIK).
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading9">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse9" aria-expanded="false" aria-controls="flush-collapse9">
                Bagaimana cara satuan pendidikan vokasi login ke tracer study ?
            </button>
        </h2>
        <div id="flush-collapse9" class="accordion-collapse collapse" aria-labelledby="flush-heading9"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Setiap satuan pendidikan vokasi dapat login ke tracer study menggunakan username dan password akun Data
                Pokok Pendidikan (Dapodik) yang dimiliki oleh kepala sekolah atau operator Dapodik.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading10">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse10" aria-expanded="false" aria-controls="flush-collapse10">
                Bagaimana cara DUDI login ke tracer study ?
            </button>
        </h2>
        <div id="flush-collapse10" class="accordion-collapse collapse" aria-labelledby="flush-heading10"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Setiap DUDI dapat login ke tracer study dengan melakukan registrasi dan melakukan aktivasi tautan yang
                dikirim ke email yang didaftarkan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading11">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse11" aria-expanded="false" aria-controls="flush-collapse11">
                Sebagai lulusan pendidikan vokasi, apa saja yang akan ditanyakan dalam tracer study ?
            </button>
        </h2>
        <div id="flush-collapse11" class="accordion-collapse collapse" aria-labelledby="flush-heading11"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                “Kamu akan menjawab serangkaian pertanyaan, silahkan diisi sesuai kondisi dan situasi kamu yang
                sebenar-benarnya, yang akan memberikan gambaran tentang hal berikut: <br>
                1. Apakah saat ini kamu bekerja, melanjutkan studi, berwirausaha, atau sedang mencari pekerjaan; <br>
                2. Sejauh mana kamu menggunakan pengetahuan dan kompetensi yang diperoleh saat menempuh pendidikan
                vokasi ke lingkup pekerjaan atau wirausaha saat ini, atau lingkup studi yang sedang dilanjutkan; <br>
                3. Masa tunggu untuk melanjutkan studi atau bekerja atau berwirausaha; <br>
                4. Pendapatan yang kamu peroleh dari bekerja atau berwirausaha; <br>
                5. Kualitas pembelajaran, praktik kerja industri, dan sertifikasi di satuan pendidikan vokasi." <br>

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading12">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse12" aria-expanded="false" aria-controls="flush-collapse12">
                Sebagai satuan pendidikan vokasi, apa saja yang ditanyakan dalam tracer study ?
            </button>
        </h2>
        <div id="flush-collapse12" class="accordion-collapse collapse" aria-labelledby="flush-heading12"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                "Setiap satuan pendidikan diharapkan memberikan informasi mengenai: <br>
                1. Profil lulusannya; <br>
                2. Pemanfaatan sarana dan prasarana DUDI untuk pembelajaran; <br>
                3. Pengembangan karir peserta didik dan pengelolaan alumni." <br>

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading13">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse13" aria-expanded="false" aria-controls="flush-collapse13">
                Apa saja yang ditanyakan dalam tracer study pada DUDI ?
            </button>
        </h2>
        <div id="flush-collapse13" class="accordion-collapse collapse" aria-labelledby="flush-heading13"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                "Setiap DUDI diharapkan memberikan informasi mengenai: <br>
                1. Kemitraan DUDI dengan satua pendidikan vokasi; <br>
                2. Daya serap tenaga kerja dari lulusan pendidikan vokasi;<br>
                3. Skill dan kompetensi apa saja yang dibutuhkan oleh DUDI; <br>
                4. Keterlibatan DUDI dalam upaya penyelarasan kebutuhan tenaga kerja dengan satuan pendidikan vokasi;
                <br>
                5. Kepuasan DUDI terhadap lulusan pendidikan vokasi." <br>

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading14">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse14" aria-expanded="false" aria-controls="flush-collapse14">
                Apakah data yang saya berikan aman?
            </button>
        </h2>
        <div id="flush-collapse14" class="accordion-collapse collapse" aria-labelledby="flush-heading14"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Jangan khawatir, setiap jawaban dalam tracer study tidak akan dipublikasikan, dan data/informasi yang
                diberikan akan dijaga aman sesuai peraturan perundang-undangan.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading15">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse15" aria-expanded="false" aria-controls="flush-collapse15">
                Siapa yang melaksanakan tracer study tahun 2022?
            </button>
        </h2>
        <div id="flush-collapse15" class="accordion-collapse collapse" aria-labelledby="flush-heading15"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Tracer study tahun 2022 difokuskan pada SMK. Untuk itu, setiap satuan pendidikan SMK wajib
                mengoptimalkan sumber daya yang dimilikinya untuk melakukan sosialisasi dan pendampingan tracer study
                kepada setiap lulusannya, khususnya lulusan tahun ajaran 2020/2021.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading16">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse16" aria-expanded="false" aria-controls="flush-collapse16">
                Apa manfaat tracer study bagi satuan pendidikan?
            </button>
        </h2>
        <div id="flush-collapse16" class="accordion-collapse collapse" aria-labelledby="flush-heading16"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                Tracer study menyediakan informasi untuk kepentingan evaluasi dan perbaikan kinerja satuan pendidikan
                vokasi untuk menghasilkan sumber daya manusia terampil yang sesuai dengan kebutuhan DUDI.
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading17">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse17" aria-expanded="false" aria-controls="flush-collapse17">
                Apa manfaat tracer study bagi DUDI?
            </button>
        </h2>
        <div id="flush-collapse17" class="accordion-collapse collapse" aria-labelledby="flush-heading17"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Hasil tracer study dapat memberikan informasi kompetensi yang dibutuhkan oleh dunia kerja, baik hard
                skills maupun soft skills, untuk direlevansikan ke dalam proses pembelajaran di satuan pendidikan
                vokasi.
                Dengan terciptanya lulusan pendidikan vokasi dengan kompetensi yang memenuhi kebutuhan skill DUDI, maka
                DUDI akan lebih mudah merekrut sumber daya manusia sesuai kebutuhannya sekaligus efisiensi cost untuk
                menjembatani skills gap.

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading18">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse18" aria-expanded="false" aria-controls="flush-collapse18">
                Bagaimana jika ada kendala error saat login atau pengisian?
            </button>
        </h2>
        <div id="flush-collapse18" class="accordion-collapse collapse" aria-labelledby="flush-heading18"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Bagi yg masih mengalami kendala pada login atau pengisian tracer study, silakan coba lakukan beberapa
                langkah berikut: <br>
                - Tekan ctrl+shift+R bersamaan (biasanya ada kendala browser karena banyak install plugin, malware,
                dll).<br>
                - Buka ulang browser dengan Chrome, atau pastikan gunakan chrome terupdate.<br>
                - Gunakan browser bawaan gadget (telepon seluler/laptop/komputer) yang digunakan.<br>
                - Gunakan gadget lainnya untuk memastikan error pada laman platform atau gadget.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading19">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse19" aria-expanded="false" aria-controls="flush-collapse19">
                Mengapa alumni tidak dapat login?
            </button>
        </h2>
        <div id="flush-collapse19" class="accordion-collapse collapse" aria-labelledby="flush-heading19"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Pertama, pastikan alumni adalah lulusan tahun 2021.<br>
                - Tracer study tahun ini diperuntukkan bagi alumni tahun lulusan 2021.<br>
                - Hanya alumni lulusan 2021 yang dapat mengakses tracer study saat ini, dan lulusan tahun lainnya akan
                ditolak oleh sistem.<br>
                - Lulusan tahun 2022 baru dapat mengakses tracer study di tahun depan (2023).<br>
                Kedua, pastikan penulisan NISN atau NIK benar:<br>
                - NISN terdiri dari 10 digit;<br>
                - NIK terdiri dari 16 digit;<br>
                - Pastikan semua digit adalah angka, tidak ada huruf atau karakter lainnya.<br>
                - Pastikan seluruh angka yang diinput merupakan NISN atau NIK alumni yang bersangkutan sesuai data
                DAPODIK.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading20">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse20" aria-expanded="false" aria-controls="flush-collapse20">
                Bagaimana jika satuan pendidikan mengalami kendala login?
            </button>
        </h2>
        <div id="flush-collapse20" class="accordion-collapse collapse" aria-labelledby="flush-heading20"
            data-bs-parent="#accordionFlushExample" style="">
            <p class="accordion-body">
                Pertama, pastikan jaringan stabil.<br>
                Kedua, pastikan telah menggunakan akun Dapodik yang dimiliki Kepala Sekolah atau Operator Dapodik untuk
                login.
                Jika dengan kedua langkah di atas kendala belum teratasi, ada kemungkinan traffic di server DAPODIK
                sedang tinggi.<br>
                Solusinya, silakan satuan pendidikan melakukan login kembali secara berkala beberapa waktu kemudian.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading21">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse21" aria-expanded="false" aria-controls="flush-collapse21">
                Apakah kepala sekolah, seluruh guru dan tenaga kependidikan wajib mengisi tracer study?
            </button>
        </h2>
        <div id="flush-collapse21" class="accordion-collapse collapse" aria-labelledby="flush-heading21"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Tidak, satuan pendidikan cukup mengisi tracer study sebanyak satu kali.

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading22">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse22" aria-expanded="false" aria-controls="flush-collapse22">
                Bagaimana jika DUDI mengalami kendala registrasi?
            </button>
        </h2>
        <div id="flush-collapse22" class="accordion-collapse collapse" aria-labelledby="flush-heading22"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                1) Cek terlebih dahulu folder spam pada email yang didaftarkan, lalu cari email verifikasi dari sistem
                tracer study.<br>
                2) Jika notifikasi tidak ditemukan, silakan klik kembali tombol "Kirim Ulang" pada halaman
                registrasi.<br>
                3) Jika langkah 2 juga terkendala, silakan melakukan registrasi kembali untuk mendapatkan email
                verifikasi.<br>
                4) Selanjutnya klik tombol "Verify Email Address" pada email verifikasi yang diterima, untuk kembali ke
                halaman login.<br>
                5) Silakan login dan menyelesaikan pengisian tracer study.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading23">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse23" aria-expanded="false" aria-controls="flush-collapse23">
                Jika ada alumni tahun 2021 telah mengisi tracer study tahun lalu, apakah tetap mengisi tracer study
                tahun 2022?
            </button>
        </h2>
        <div id="flush-collapse23" class="accordion-collapse collapse" aria-labelledby="flush-heading23"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Mengingat alumni tahun 2021 tidak menjadi sasaran tracer study tahun 2022 dan terdapat perubahan
                instrumen dan struktur data tracer study tahun 2022 yang nantinya akan ditarik menjadi data nasional,
                maka seluruh alumni tahun 2021 wajib mengisi tracer study tahun 2022 sekalipun telah mengisi tracer
                study tahun sebelumnya.

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading24">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse24" aria-expanded="false" aria-controls="flush-collapse24">
                Bagaimana pengisian tracer study untuk alumni tahun 2022?
            </button>
        </h2>
        <div id="flush-collapse24" class="accordion-collapse collapse" aria-labelledby="flush-heading24"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                - Data alumni tahun 2022 yang masuk tahun ini, tidak akan menjadi bahan pengolahan data tahun ini.<br>
                - Terutama dalam hal kebekerjaan (bekerja, berwirausaha, melanjutkan studi, atau masih mencari
                pekerjaan) lulusan 2022 baru akan akurat untuk diukur tahun 2023.<br>
                - Dengan demikian, lulusan 2022 tidak perlu mengisi tracer study tahun 2022.<br>
                - Namun demikian, setiap sekolah disarankan mulai memvalidasi data/kontak alumni tahun 2022 dan tetap
                mensosialisasikan pengisian tracer study oleh mereka di pertengahan tahun 2023.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading25">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse25" aria-expanded="false" aria-controls="flush-collapse25">
                Mengapa tombol "Simpan dan lanjut" atau "Kirim" tidak dapat di klik?
            </button>
        </h2>
        <div id="flush-collapse25" class="accordion-collapse collapse" aria-labelledby="flush-heading25"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Jika tombol "Simpan dan lanjut" atau "Kirim" tidak dapat di klik, artinya masih terdapat jawaban yang
                terlewat oleh alumni. Pastikan setiap pertanyaan telah dijawab dengan memilih opsi yang tersedia, atau
                mengisi kolom yang tersedia, atau memilih nilai skala Likert dengan menggeser tombol yang tersedia.

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading26">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse26" aria-expanded="false" aria-controls="flush-collapse26">
                Bagaimana satuan pendidikan dapat memantau pengisian tracer study alumninya?
            </button>
        </h2>
        <div id="flush-collapse26" class="accordion-collapse collapse" aria-labelledby="flush-heading26"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Pertama, satuan pendidikan wajib terlebih dahulu mengisi instrumen tracer study, silakan login
                menggunakan akun Dapodik yang dimiliki Kepala Sekolah atau Operator Dapodik. Jika sudah mengisi,
                selanjutnya cukup login saja.<br>
                Kedua, pada halaman akhir yang muncul, klik tombol "Dashboard" di sudut kiri atas, untuk melihat:<br>
                - Persentase alumni yang telah dan sedang mengisi terhadap jumlah populasi alumni yang disurvei;<br>
                - Daftar nama alumni yang telah dan sedang mengisi tracer study.<br>
                Selanjutnya satuan pendidikan mengidentifikasi dan mendorong alumni yang belum mengisi tracer study.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading27">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse27" aria-expanded="false" aria-controls="flush-collapse27">
                Mengapa alumni telah mengisi namun tidak muncul di dashboard satuan pendidikan?
            </button>
        </h2>
        <div id="flush-collapse27" class="accordion-collapse collapse" aria-labelledby="flush-heading27"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                - Sasaran tracer study tahun 2022 adalah seluruh alumni SMK lulusan tahun 2021.<br>
                - Hingga pertengahan September 2022, alumni tahun lulusan 2022 masih dapat mengisi tracer study, namun
                data yang masuk tidak akan menjadi bahan pengolahan data tahun ini.<br>
                - Hanya data alumni lulusan tahun 2021 yang akan muncul pada dashboard masing-masing satuan pendidikan,
                dan akan dihitung untuk data nasional dan provinsi.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading28">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse28" aria-expanded="false" aria-controls="flush-collapse28">
                Bagaimana mencari nama perguruan tinggi bagi alumni yang melanjutkan pendidikan?
            </button>
        </h2>
        <div id="flush-collapse28" class="accordion-collapse collapse" aria-labelledby="flush-heading28"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Pertama, pastikan menggunakan kata kunci pencarian yg merupakan bagian dari kepanjangan nama PT tersebut
                sesuai yang terdaftar dalam Pangkalan Data Pendidikan Tinggi (PD DIKTI).<br>
                Contoh: Universitas Gadjah Mada<br>
                Kata kuncinya adalah "Gadjah" atau "Mada"<br>
                Pencarian dg kata kunci "gajah" (tanpa huruf "d") atau "UGM" hasilnya tidak akan ditemukan.<br>
                <br>
                Kedua, jika nama perguruan tinggi tidak ditemukan juga, silakan pilih jawaban "Lainnya", lalu isikan
                nama perguruan tinggi pada kolom yang tersedia.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading29">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse29" aria-expanded="false" aria-controls="flush-collapse29">
                Jika suatu SMK Pelaksana Program Pusat Keunggulan ditetapkan pada beberapa tahun yang berbeda, tahun
                penatapan mana yang diisi dalam tracer study?
            </button>
        </h2>
        <div id="flush-collapse29" class="accordion-collapse collapse" aria-labelledby="flush-heading29"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Tahun penetapan dan konsentrasi keahlian yang diisi dalam tracer study untuk satuan pendidikan adalah
                penetapan tahun 2021.<br>
                Begitu juga dengan poin "Bagaimana capaian kerja sama dengan DUDI selama menjadi SMK PK pada kompetensi
                keahlian tersebut", mengacu pada capaian 2021.<br>
                Poin-poin tersebut sekaligus akan menjadi bahan evaluasi kinerja SMK Pelaksana Program Pusat Keunggulan
                oleh Kemendikbudristek.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading30">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse30" aria-expanded="false" aria-controls="flush-collapse30">
                Bolehkah satuan pendidikan mencoba mengisi tracer study untuk DUDI?
            </button>
        </h2>
        <div id="flush-collapse30" class="accordion-collapse collapse" aria-labelledby="flush-heading30"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Tracer study untuk responden DUDI sepenuhnya menggali dari sudut pandang DUDI.<br>
                Tidak hanya data, tetapi juga informasi sampai dengan umpan balik DUDI terhadap pendidikan vokasi,
                khususnya SMK.<br>
                Semua informasi DUDI akan sangat berharga untuk refleksi dan evaluasi demi meningkatkan kualitas vokasi
                ke depan.<br>
                Jadi, alangkah elegannya jika kita bersama-sama menjaga agar cermin dari DUDI yang sejatinya bisa kita
                peroleh, dan tracer study bisa berfungsi sebagaimana mestinya.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading31">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse31" aria-expanded="false" aria-controls="flush-collapse31">
                Apakah tersedia petunjuk pengisian tracer study?
            </button>
        </h2>
        <div id="flush-collapse31" class="accordion-collapse collapse" aria-labelledby="flush-heading31"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Kemdikbudristek telah menyiapkan Petunjuk Pengisian Tracer Study untuk masing-masing responden:<br>
                - Alumni;<br>
                - DUDI;<br>
                - Satuan Pendidikan.<br>
                Ketiga jenis petunjuk pengisian tersebut dapat diunduh di laman tracervokasi.kemdikbud.go.id.<br>
                Setiap petunjuk pengisian telah dilengkapi dengan step by step pengisian beserta screenshoot tampilan
                (visual) agar mudah diikuti.<br>
                Petunjuk Pengisian bagi DUDI telah dilengkapi data dan informasi apa saja yang perlu disiapkan untuk
                mengisi tracer study.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading32">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse32" aria-expanded="false" aria-controls="flush-collapse32">
                Bagaimana kriteria DUDI yang mengisi tracer study?
            </button>
        </h2>
        <div id="flush-collapse32" class="accordion-collapse collapse" aria-labelledby="flush-heading32"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                DUDI yang telah bekerja sama dengan satuan pendidikan vokasi, baik yang telah dituangkan melalui MoU
                ataupun belum, baik yang merekrut lulusan pendidikan vokasi ataupun belum, sangat diharapkan mengisi
                tracer study pada bagian pertama, tentang profil dan kebutuhan tenaga kerja.<br>
                Lebih lanjut bagi DUDI yang telah merekrut lulusan pendidikan vokasi di institusinya, diharapkan dapat
                melanjutkan pengisian tracer study pada bagian kedua, tentang evaluasi lulusan SMK, yang tersedia
                setelah selesai pengisian bagian pertama.<br>

            </p>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="flush-heading33">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#flush-collapse33" aria-expanded="false" aria-controls="flush-collapse33">
                Apakah data alumni/DUDI/satuan pendidikan telah dikirim dapat diubah?
            </button>
        </h2>
        <div id="flush-collapse33" class="accordion-collapse collapse" aria-labelledby="flush-heading33"
            data-bs-parent="#accordionFlushExample">
            <p class="accordion-body">
                Tidak.<br>
                Jika alumni/DUDI/satuan pendidikan hendak mengubah sebagain data yang telah dikirimkan, maka data yang
                telah dikirim harus dihapus (reset) terlebih dahulu kemudian alumni/DUDI/satuan pendidikan kembali
                mengisi tracer study dari awal. Silakan menghubungi admin melalui kontak yang tersedia untuk mengajukan
                permohonan reset data.<br>

            </p>
        </div>
    </div>
</div> --}}
