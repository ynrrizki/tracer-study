@extends('layouts.main')

@section('content')
    {{-- header --}}
    @include('partials.header')
    <section id="info">

    </section>
    <section id="faq" class="bg-white">
        <div class="container mx-auto px-4 lg:max-w-7xl py-10">
            <h1 class="text-2xl font-bold">FAQ Tracer Study Pendidikan Vokasi</h1>
            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-white rounded-box mt-5">
                <input type="checkbox" class="peer" />
                <div class="collapse-title text-xl font-medium">
                    Apa itu Tracer Study Pendidikan Vokasi
                </div>
                <div class="collapse-content">
                    <p>
                        Tracer study pendidikan vokasi, selanjutnya disebut tracer study, merupakan survei untuk mengetahui
                        aktivitas kebekerjaan (bekerja, wirausaha dan melanjutkan pendidikan), keselarasan, dan kepuasan
                        dunia
                        kerja
                        terhadap lulusan pendidikan vokasi setelah satu tahun lulus dari satuan pendidikan vokasi.
                    </p>
                </div>
            </div>
            <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-white rounded-box mt-5">
                <input type="checkbox" class="peer" />
                <div class="collapse-title text-xl font-medium">
                    Kapan Waktu Pengisian Tracer Study
                </div>
                <div class="collapse-content">
                    <p>
                        Waktu pengisian tracer study tahun 2022 adalah mulai 5 September 2022 hingga 31 Oktober 2022.</p>
                </div>
            </div>
        </div>
    </section>
    {{-- footer --}}
    @include('partials.footer')
@endsection
