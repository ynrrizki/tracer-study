@extends('layouts.auth')

@section('content')
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf
        <div class="form-control">
            <label class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="text" placeholder="Email" class="input input-bordered" name="email" value="{{ old('email') }}" />
            <label class="label">
                <span class="label-text">Password</span>
            </label>
            <input type="password" placeholder="Password" class="input input-bordered" name="password" />
        </div>
        <div class="form-control mt-6">
            <button type="submit" class="btn btn-primary text-white">Login</button>
        </div>
    </form>
@endsection
