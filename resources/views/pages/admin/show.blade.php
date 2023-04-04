@extends('layouts.dash')

@section('header')
    Detail Alumni
@endsection

@section('content')
    @push('addon-css')
        <!-- Custom styles for this page -->
        <link href="{{ asset('themes/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <style>
            .student-profile .card {
                border-radius: 10px;
            }

            .student-profile .card .card-header .profile_img {
                width: 150px;
                height: 150px;
                object-fit: cover;
                margin: 10px auto;
                border: 10px solid #ccc;
                border-radius: 50%;
            }

            .student-profile .card h3 {
                font-size: 20px;
                font-weight: 700;
            }

            .student-profile .card p {
                font-size: 16px;
                color: #000;
            }

            .student-profile .table th,
            .student-profile .table td {
                font-size: 14px;
                padding: 5px 10px;
                color: #000;
            }
        </style>
    @endpush

    <!-- DataTables -->
    {{-- <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Alumni</h3>

                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Action <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" data-toggle="modal"
                                data-target="#excelImportModal">Import</a>
                            <a class="dropdown-item" href="{{ route('file-export') }}">Export</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Generate Report</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <p><b>Nama</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div>
                        <p>{{ $alumni->name }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p><b>Email</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div class="col-5">
                        <p>{{ $alumni->email }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p><b>NIK</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div class="col-5">
                        <p>{{ $alumni->nik }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p><b>Jurusan</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div class="col-5">
                        <p>{{ $alumni->personalData->major->name ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p><b>Alamat</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div class="col-5">
                        <p>{{ $alumni->personalData->address ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p><b>Nomer Handphone</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div class="col-5">
                        <p>{{ $alumni->personalData->phone ?? '-' }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <p><b>Tanggal lahir</b></p>
                    </div>
                    <div class="col-2">
                        :
                    </div>
                    <div class="col-5">
                        <p>{{ $alumni->personalData->birth_date ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="student-profile py-4 col-12">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent text-center">
                        <img class="profile_img" src="https://source.unsplash.com/600x300/?student" alt="student dp">
                        <h3>{{ $alumni->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">
                            <strong class="pr-1">NIK:</strong>{{ $alumni->nik }}
                        </p>
                        <p class="mb-0">
                            <strong class="pr-1">Jurusan:</strong>{{ $alumni->personalData->major->name ?? '-' }}
                        </p>
                        <p class="mb-0">
                            <strong class="pr-1">Alamat:</strong>{{ $alumni->personalData->address ?? '-' }}
                        </p>
                        <p class="mb-0">
                            <strong class="pr-1">
                                No HP:
                            </strong>{{ $alumni->personalData->phone ?? '-' }}
                        </p>
                        <p class="mb-0">
                            <strong class="pr-1">
                                Tanggal Lahir:
                            </strong>{{ $alumni->personalData->birth_date ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Informasi Survey</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            @foreach ($surveyQuestions as $key => $question)
                                @foreach ($alumni->answers as $answer)
                                    @if ($question->id == $answer->question_id)
                                        <tr>
                                            <th width="30%">{{ $question->name }}</th>
                                            <td width="2%">:</td>
                                            <td>{{ $answer->fill ?? '-' }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                </div>
                <div style="height: 26px"></div>
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent border-0">
                        <h3 class="mb-0"><i class="far fa-clone pr-1"></i>Feed Back</h3>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table table-bordered">
                            @foreach ($feedBackQuestions as $key => $question)
                                @foreach ($alumni->answers as $answer)
                                    @if ($question->id == $answer->question_id)
                                        <tr>
                                            <th width="30%">{{ $question->name }}</th>
                                            <td width="2%">:</td>
                                            <td>{{ $answer->fill ?? '-' }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
