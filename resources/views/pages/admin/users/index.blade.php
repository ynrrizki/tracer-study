@extends('layouts.dash')

@section('header')
    User Management
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">User List</li>
@endsection

@section('content')
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
                            <a class="dropdown-item" href="{{ route('users.create') }}">Create</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('file-import') }}" data-toggle="modal"
                                data-target="#excelImportModal">Import</a>
                            <a class="dropdown-item" href="{{ route('file-export') }}">Export</a>

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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>NIK</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->nik }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
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
