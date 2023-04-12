@extends('layouts.dash')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Informasi Profil</h4>
            <p class="card-sub-title">Update akun profiel informasi dan alamat email</p>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.store') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    @fields([
                        'label' => 'Nama Lengkap',
                        'name' => 'name',
                        'placeholder' => 'Yanuar Rizki Sanjaya',
                        'type' => 'text',
                        'value' => $user->name,
                    ])
                </div>
                <div class="col-md-6">
                    @fields([
                        'label' => 'Email',
                        'name' => 'email',
                        'placeholder' => 'yanuarrizki165@gmail.com',
                        'type' => 'email',
                        'value' => $user->email,
                    ])
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Update Password</h4>
            <p class="card-sub-title">Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman</p>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.store') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    @fields([
                        'label' => 'Password Sekarang',
                        'name' => 'currentPass',
                        'placeholder' => '',
                        'type' => 'password',
                        // 'value' => $user->name,
                    ])
                </div>
                <div class="col-md-6">
                    @fields([
                        'label' => 'Password Terbaru',
                        'name' => 'password',
                        'placeholder' => '',
                        'type' => 'password',
                        // 'value' => $user->email,
                    ])
                </div>
                <div class="col-md-6">
                    @fields([
                        'label' => 'Konfirmasi Password',
                        'name' => 'password_confirmation',
                        'placeholder' => '',
                        'type' => 'password',
                        // 'value' => $user->email,
                    ])
                </div>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
    <div class="card mt-5">
        <div class="card-header">
            <h4 class="card-title">Hapus Akun</h4>
            <p class="card-sub-title">Setelah akun Anda dihapus. semua sumber daya dan datanya akan dihapus secara
                permanen.</p>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.store') }}" method="POST">
                @csrf
                <button class="btn btn-danger">Hapus Akun</button>
            </form>
        </div>
    </div>
@endsection
