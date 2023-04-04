@extends('layouts.auth')

@section('content')
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div class="form-control">
            <label class="label">
                <span class="label-text">NIK</span>
            </label>
            <input type="text" placeholder="NIK" class="input input-bordered" name="nik" value="{{ old('nik') }}" />
        </div>
        <div class="form-control mt-6">
            <label class="label">
                <span class="label-text font-bold">Google RECAPTCHA</span>
            </label>

            {!! NoCaptcha::renderJs() !!}
            {!! NoCaptcha::display() !!}
        </div>
        <div class="form-control mt-6">
            <p>
                Gunakan <b>NIK</b> yang Anda miliki untuk masuk
            </p>
        </div>
        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary btn-block text-white">LOG IN</button>
        </div>
    </form>
@endsection
