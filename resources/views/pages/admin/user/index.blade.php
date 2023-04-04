@extends('layouts.dash')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Yang Sudah Mengisi</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">21,459</h4>
                                {{-- <small class="text-success">(+29%)</small> --}}
                            </div>
                            <small>Total Alumni</small>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                            <i class="bx bx-user bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Yang belum mengisi</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">237</h4>
                                {{-- <small class="text-success">(+42%)</small> --}}
                            </div>
                            <small>Total Alumni</small>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                            <i class="bx bx-user-voice bx-sm"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="card-title">Daftar Alumni</h5>
            <div class="card-actions">
                <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasAlumni" aria-controls="offcanvasAlumni">
                    <span>
                        <i class="bx bx-plus me-1"></i>
                        <span class="d-none d-lg-inline-block">
                            Tambah Alumni
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
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('file-export') }}">
                                <i class='bx bx-chevron-right scaleX-n1-rtl'></i>
                                Export
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"
                                data-bs-toggle="modal" data-bs-target="#backDropModal"><i
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
                <x-table :headers="$headers" :data="$data" :delete="'user.destroy'" :offcanvasId="'offcanvasAlumni'" />
            </div>
        </div>
        <!-- Offcanvas to form alumni -->
        <x-offcanvas :title="'Form Alumni'" :id="'offcanvasAlumni'">
            <form class="form-alumni pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="alumniForm"
                action="{{ route('user.store') }}" method="POST">
                @csrf
                @fields([
                    'label' => 'Nama Lengkap',
                    'name' => 'name',
                    'placeholder' => 'Yanuar Rizki Sanjaya',
                    'type' => 'text',
                ])
                @fields([
                    'label' => 'Email',
                    'name' => 'email',
                    'placeholder' => 'yanuarrizki165@gmail.com',
                    'type' => 'email',
                ])
                @fields([
                    'label' => 'NIK',
                    'name' => 'nik',
                    'placeholder' => '1234567890123456',
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
    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('file-import') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();

                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let url_edit = "{{ route('user.edit', ':id') }}";
                    let url_update = "{{ route('user.update', ':id') }}";
                    url_edit = url_edit.replace(':id', id);
                    url_update = url_update.replace(':id', id);

                    $.ajax({
                        url: url_edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            $('#alumniForm').append('@method('PUT')');
                            $('#name').val(data.name);
                            $('#email').val(data.email);
                            $('#nik').val(data.nik);
                            $('#type_school_id').val(data.type_school_id);
                            $('#alumniForm').attr('action', url_update);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                $('#offcanvasAlumni').on('hidden.bs.offcanvas', function() {
                    let url_store = "{{ route('user.store') }}";
                    if (!$(this).hasClass('show')) {
                        $('#alumniForm')[0].reset();
                        $('#alumniForm').attr('action', url_store);
                        $('#alumniForm > input[name="_method"]').remove();
                    }
                });
            });
        </script>
    @endpush
@endsection
