@extends('layouts.dash')

@section('header')
    Dashboard
@endsection

@section('breadcrumb')
    {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
@endsection

@section('cards')
    @include('partials.dash.cards', [
        'finish' => $finished_filling,
        'current' => $currently_filling,
    ])
@endsection
@section('content')
    {{-- @include('partials.dash.cards', ['current' => $currently_filling, 'finish' => $finished_filling]) --}}
    @push('addon-css')
        <!-- Custom styles for this page -->
        <link href="{{ asset('themes/sb-admin-2/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endpush

    <div class="col-12">
        <!-- /.card -->
        <div class="card">
            <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Daftar Alumni</h3>
                <ul class="nav nav-pills ml-auto p-2">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            Action <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('file-import') }}" data-toggle="modal"
                                data-target="#excelImportModal">Import</a>
                            <a class="dropdown-item" href="{{ route('file-export') }}">Export</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Generate Report</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered table-striped" id="alumniTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Status</th>
                            {{-- <th>Tahun</th> --}}
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Status</th>
                            {{-- <th>Tahun</th> --}}
                            <th>Jurusan</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($alumnus as $alumni)
                            @php
                            @endphp
                            <tr>
                                <td>{{ $alumni->name }}</td>
                                <td>{{ $alumni->nik }}</td>
                                <td>{{ $alumni->email }}</td>
                                <td>{{ $alumni->answers[0]->fill ?? '-' }}</td>
                                <td>{{ $alumni->personalData->major->name ?? '-' }}</td>
                                <td><a href="{{ route('admin.show', $alumni->id) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <!-- /.card -->
    </div>

    <!-- DataTables -->

    <!-- Excel Import Modal-->
    <div class="modal fade" id="excelImportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Alumni</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file" accept=".csv">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        @csrf
                        <button class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('addon-modal')
        <!-- Detail Alumni Modal-->
        <div class="modal fade" id="alumniDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Data Alumni</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <p><b>Nama</b></p>
                            </div>
                            <div class="col-2">
                                :
                            </div>
                            <div class="col-5">
                                <p>Yanuar Rizki Sanjaya</p>
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
                                <p>Rekayasa Perangkat Lunak</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form action="{{ route('file-export') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <button class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('addon-js')
        <script src="{{ asset('themes/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('themes/admin-lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>

        <script>
            $(function() {
                $("#alumniTable").DataTable({
                    "responsive": true,
                    "lengthChange": true,
                    "autoWidth": false,
                    // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#alumniTable_wrapper .col-md-6:eq(0)');
            });
        </script>
    @endpush
@endsection
