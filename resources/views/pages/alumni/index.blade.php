@extends('layouts.main', ['bgBody' => 'bg-primary-50', 'isNavbar' => false, 'isFooter' => false])


@section('content')
    @push('addon-css')
        @livewireStyles
    @endpush
    <section class="container p-4 max-w-7xl mx-auto">
        <div class="row mb-12">
            @livewire('form-alumni', [
                'answers' => $answers,
                'personalData' => $personalData,
                'alumni' => $alumni,
                'majors' => $majors,
                'questions' => $questions,
                'isFinished' => $isFinished,
            ])
        </div>
    </section>
    {{-- </div> --}}
    @push('addon-js')
        @livewireScripts
    @endpush
@endsection
