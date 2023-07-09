@extends('layouts.dash')

@section('content')
    <div class="card">
        <h5 class="card-header d-flex justify-content-between">
            Daftar Operator
            <button class="btn btn-secondary create-new btn-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasAddOperator" aria-controls="offcanvasEnd">
                <span>
                    <i class="bx bx-plus me-1"></i>
                    <span class="d-none d-lg-inline-block">
                        Tambah Operator Baru
                    </span>
                </span>
            </button>
        </h5>
        <div class="card-body">
            <x-table :headers="$headers" :data="$data" :delete="'operator.destroy'" :offcanvasId="'offcanvasAddOperator'" />
        </div>
    </div>

    <x-offcanvas :title="'Add Operator'" :id="'offcanvasAddOperator'">
        <form action="{{ route('operator.store') }}" class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework"
            id="operatorForm" method="POST">
            @csrf
            @field([
                'label' => 'Nama Lengkap',
                'name' => 'name',
                'placeholder' => 'John Doe',
                'type' => 'text',
            ])
            @field([
                'label' => 'Email',
                'name' => 'email',
                'placeholder' => 'john.doe@example.com',
                'type' => 'text',
            ])
            @field([
                'label' => 'Username',
                'name' => 'username',
                'placeholder' => 'john123',
                'type' => 'text',
            ])
            @field([
                'label' => 'Password',
                'name' => 'password',
                'placeholder' => 'password',
                'type' => 'password',
            ])
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
    </x-offcanvas>
    {{-- <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddOperator" aria-labelledby="offcanvasAddUserLabel"
        aria-modal="true" role="dialog">
        <div class="offcanvas-header">
            <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add Operator</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form action="{{ route('operator.store') }}"
                class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewUserForm" method="POST">
                @csrf
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="John Doe" name="name"
                        aria-label="John Doe" fdprocessedid="fbaoc8">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="email">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="john.doe@example.com"
                        aria-label="john.doe@example.com" name="email">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="username">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="john123" aria-label="john123"
                        name="username">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <div class="mb-3 fv-plugins-icon-container">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="password" aria-label="password"
                        name="password">
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>

            </form>
        </div>
    </div> --}}
    @push('addon-js')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();

                $(document).on('click', '.btn-edit', function() {
                    let id = $(this).data('id');
                    let edit = "{{ route('operator.edit', ':id') }}";
                    let update = "{{ route('operator.update', ':id') }}";
                    edit = edit.replace(':id', id);
                    update = update.replace(':id', id);

                    $.ajax({
                        url: edit,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            console.log(data);
                            $('#operatorForm').append('@method('PUT')');
                            $('#id').val(data.id);
                            $('#name').val(data.name);
                            $('#email').val(data.email);
                            $('#username').val(data.username);
                            $('#operatorForm').attr('action', update);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                });

                $('#offcanvasAddOperator').on('hidden.bs.offcanvas', function() {
                    let store = "{{ route('operator.store') }}";
                    if (!(this).hasClass('show')) {
                        $('#operatorForm')[0].reset();
                        $('#operatorForm').attr('action', store);
                        $('input[name="_method"]').remove();
                    }
                });
            });
            // $(function() {
            //     $("#myTable").DataTable({
            //         dom: '<"card-header"<"head-label text-center"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            //         displayLength: 7,
            //         lengthMenu: [7, 10, 25, 50, 75, 100],
            //         buttons: [{
            //                 extend: 'collection',
            //                 className: 'btn btn-label-primary dropdown-toggle me-2',
            //                 text: '<i class="bx bx-show me-1"></i>Export',
            //                 buttons: [{
            //                         extend: 'print',
            //                         text: '<i class="bx bx-printer me-1" ></i>Print',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'csv',
            //                         text: '<i class="bx bx-file me-1" ></i>Csv',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'excel',
            //                         text: 'Excel',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'pdf',
            //                         text: '<i class="bx bxs-file-pdf me-1"></i>Pdf',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     },
            //                     {
            //                         extend: 'copy',
            //                         text: '<i class="bx bx-copy me-1" ></i>Copy',
            //                         className: 'dropdown-item',
            //                         exportOptions: {
            //                             columns: [3, 4, 5, 6, 7]
            //                         }
            //                     }
            //                 ]
            //             },
            //             {
            //                 text: '<i class="bx bx-plus me-1"></i> <span class="d-none d-lg-inline-block">Add New Record</span>',
            //                 className: 'create-new btn btn-primary'
            //             }
            //         ],
            //     });
            // });
        </script>
    @endpush
@endsection
