@extends('layouts.dash')

@section('content')
    @include('partials.dash.total-alumni', [
        'currently_filling' => $currently_filling,
        'finished_filling' => $finished_filling,
    ])
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
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('alumni.file-export') }}">
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
                <x-table :headers="$headers" :data="$data" :delete="'user.destroy'" :offcanvasId="'offcanvasAlumni'" :canShow="true"
                    :show="'user.show'" />
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
                    'placeholder' => '31750XXXXXXXXXXX',
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
                @fields([
                    'label' => 'Tahun Angkatan',
                    'name' => 'grade_at',
                    'placeholder' => '2023',
                    'type' => 'text',
                ])
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
            </form>
        </x-offcanvas>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="{{ route('alumni.file-import') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="backDropModalTitle">Import Alumni</h5>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>NIK</th>
                                        <th>Lembaga SMA/SMK</th>
                                        <th>Tahun Lulus</th>
                                    </tr>
                                </thead>
                            </table>
                            {{-- <table class="table table-bordered py-4" id="myTable">
                                <thead>
                                    <tr>
                                        @foreach ($headers as $header)
                                            <th>{{ $header }}</th>
                                        @endforeach
                                        @if ($canDelete || $canEdit)
                                            <th>actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            @foreach ($row as $cell)
                                                @if ($cell != $loop->first)
                                                    <td>
                                                        {!! $cell !!}
                                                    </td>
                                                @endif
                                            @endforeach

                                            @if ($canDelete || $canEdit)
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown"><i
                                                                class="bx bx-dots-vertical-rounded"></i></button>
                                                        <div class="dropdown-menu">
                                                            @if ($canEdit)
                                                                <button type="button" class="btn-edit dropdown-item"
                                                                    data-bs-toggle="offcanvas"
                                                                    data-bs-target="#{{ $offcanvasId }}"
                                                                    aria-controls="offcanvasEnd"
                                                                    data-id="{{ $row[0] }}"><i
                                                                        class="bx bx-edit-alt me-1"></i>
                                                                    Edit
                                                                </button>
                                                            @endif
                                                            @if ($canDelete)
                                                                <form action="{{ route($delete, $row[0]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">
                                                                        <i class="bx bx-trash me-1"></i>
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table> --}}
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

    <div class="modal fade" id="attachMailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Mengirim Email Ke Alumni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <input type="hidden" name="emailForSend" id="emailForSend">
                            <label for="message" class="form-label">Sampaikan Pesan:</label>
                            <textarea name="message" id="message" class="form-control" placeholder="message"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="submitMail btn btn-primary">Send Email</button>
                </div>
            </div>
        </div>
    </div>






    @push('addon-js')
        <script>
            $(document).on('click', '.sendMail', function() {
                let user = $(this).data('user');
                $('#emailForSend').val(user.email);
                // $('#attachMailModal').find('.modal-title').append('Mengirim Email Ke ' + $('#emailForSend').val());
            });

            $(document).on('click', '.submitMail', function() {
                let data = {};
                data.email = $('#emailForSend').val();
                data.message = $('#message').val();
                data._token = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('sendMail') }}",
                    type: 'POST',
                    dataType: 'JSON',
                    data: data,
                    success: function(data) {
                        console.log(data);
                        $('#attachMailModal').removeClass('fade')
                        $(".modal-backdrop").remove();
                        $('#attachMailMoal').hide();
                        $('.user-send').remove();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    },
                })
            });




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
                            $('#grade_at').val(data.grade_at);
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
