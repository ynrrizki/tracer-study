@extends('layouts.main')

@section('content')
    @push('addon-css')
        @livewireStyles
    @endpush
    <section class="container p-4 lg:max-w-7xl mx-auto my-20 md:my-36">

        @livewire('form-alumni', [
            'answers' => $answers,
            'personalData' => $personalData,
            'alumni' => $alumni,
            'majors' => $majors,
            'questions' => $questions,
        ])

    </section>
    @push('addon-js')
        @livewireScripts
        @stack('livewire-script')
    @endpush
@endsection
