@extends('layouts.dash')

@section('content')
    @if (session()->has('failures'))
        <div class="alert alert-danger border border-danger alert-dismissible" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
            <table class="table table-bordered border-danger py-4">
                <thead>
                    <tr>
                        <th>Baris</th>
                        <th>Atribut</th>
                        <th>Error</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (session('failures') as $failure)
                        <tr>
                            <td>{{ $failure->row() }}</td>
                            <td>{{ $failure->attribute() }}</td>
                            <td>
                                <ul>
                                    @foreach ($failure->errors() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    @foreach ($failure->values() as $value)
                                        <li>{{ $value }}</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Daftar Alumni</h5>
            <div class="card-actions">
                <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasJurusan" aria-controls="offcanvasJurusan">
                    <span>
                        <i class="bx bx-plus me-1"></i>
                        <span class="d-none d-lg-inline-block">
                            Tambah Jurusan
                        </span>
                    </span>
                </button>
                <!-- Icon Dropdown -->
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary btn-icon dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('major.file-export') }}">
                                <i class='bx bx-chevron-right scaleX-n1-rtl'></i>
                                Export
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                data-bs-toggle="modal" data-bs-target="#majorImportModal"><i
                                    class="bx bx-chevron-right scaleX-n1-rtl"></i>
                                Import
                            </a>
                        </li>
                        {{-- <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i
                                    class="bx bx-chevron-right scaleX-n1-rtl"></i>
                                Something else here
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:void(0);">Separated link</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive text-nowrap">
                @php
                    $delete = 'major.destroy';
                    $offcanvasId = 'offcanvasJurusan';
                    $canEdit = true;
                    $canDelete = true;
                @endphp
                <x-table :headers="$headers" :data="$data" :delete="$delete" :offcanvasId="$offcanvasId" :canEdit="$canEdit" :canDelete="$canDelete" />
            </div>
        </div>
        <!-- Offcanvas to form jurusan -->
        <x-offcanvas :title="'Form Jurusan'" :id="'offcanvasJurusan'">
            <form class="form-jurusan pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="jurusanForm"
                action="{{ route('major.store') }}" method="POST">
                @csrf
                @fields([
                    'label' => 'Nama Jurusan',
                    'name' => 'name',
                    'placeholder' => 'Rekayasa Perangkat Lunak',
                    'type' => 'text',
                ])
                @fields([
                    'label' => 'Tahun Pergantian <span class="text-danger">"kosongkan apabila belum ada"</span>',
                    'name' => 'expired_year',
                    'placeholder' => '2023',
                    'type' => 'text',
                ])
                @fields([
                    'label' => 'Lembaga',
                    'name' => 'type_school_id',
                    'type' => 'select',
                    'options' => $type_schools->map(function ($type_school) {
                            return '<option value="' . $type_school->id . '">' . $type_school->name . '</option>';
                        })->join(' '),
                ])
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </x-offcanvas>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="majorImportModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('major.file-import') }}" enctype="multipart/form-data"
                method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="majorImportModalTitle">Import Alumni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered py-4">
                                <thead>
                                    <tr>
                                        <th colspan="5">urutan column excel</th>
                                    </tr>
                                    <tr>
                                        <th>Nama Jurusan</th>
                                        <th>Lembaga SMA/SMK</th>
                                        <th>Tahun Pergantian <br><span class="text-danger">"BOLEH DIKOSONGKAN"</span>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBackdrop" class="form-label">File Import</label>
                            <input type="file" id="nameBackdrop" class="form-control" placeholder="Enter File"
                                name="file">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>






    @push('addon-js')
        @if (session()->has('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                    showConfirmButton: true,
                    confirmButtonColor: "#ff6a00",
                })
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
                @if ($errors->has('file'))
                    $('#majorImportModal').modal('show');
                @endif
                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let url_edit = "{{ route('major.edit', ':id') }}";
                    let url_update = "{{ route('major.update', ':id') }}";
                    url_edit = url_edit.replace(':id', id);
                    url_update = url_update.replace(':id', id);

                    $.ajax({
                        url: url_edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            $('#jurusanForm').append('@method('PUT')');
                            $('#name').val(data.name);
                            $('#expired_year').val(data.expired_year);
                            $('#type_school_id').val(data.type_school_id);
                            $('#jurusanForm').attr('action', url_update);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                $('#offcanvasJurusan').on('hidden.bs.offcanvas', function() {
                    let url_store = "{{ route('major.store') }}";
                    if (!$(this).hasClass('show')) {
                        $('#jurusanForm')[0].reset();
                        $('#jurusanForm').attr('action', url_store);
                        $('#jurusanForm > input[name="_method"]').remove();
                    }
                });
            });
        </script>
    @endpush
@endsection
