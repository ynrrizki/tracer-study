@extends('layouts.main', ['bgBody' => 'bg-primary-50', 'isNavbar' => false, 'isFooter' => false])


@section('content')
    @push('addon-css')
        @livewireStyles
    @endpush
    {{-- <div class="min-h-screen w-full bg-primary-50">
        <div class="container min-h-screen flex flex-col items-center">
            <div class="row mb-12">
                @livewire('form-alumni', [
                    'answers' => $answers,
                    'personalData' => $personalData,
                    'alumni' => $alumni,
                    'majors' => $majors,
                    'questions' => $questions,
                ])
            </div>
        </div>
    </div> --}}
    {{-- <div class="min-h-screen w-full bg-primary-50"> --}}
    <section class="container p-4 lg:max-w-7xl">
        <div class="row mb-12">
            @livewire('form-alumni', [
                'answers' => $answers,
                'personalData' => $personalData,
                'alumni' => $alumni,
                'majors' => $majors,
                'questions' => $questions,
            ])
        </div>
    </section>
    {{-- </div> --}}
    @push('addon-js')
        @livewireScripts
    @endpush
@endsection
