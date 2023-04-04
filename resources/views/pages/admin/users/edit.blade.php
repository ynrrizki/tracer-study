@extends('layouts.dash')

@section('content')
    <div class="col-md-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit</h3>
                {{-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div> --}}
            </div>
            <form action="{{ route('users.update', $user->id) }}">
                <div class="card-body">
                    @field([
                        'type' => 'text',
                        'label' => 'Nama Siswa',
                        'name' => 'name',
                        'value' => $user->name,
                    ])
                    @field([
                        'type' => 'text',
                        'label' => 'NIK',
                        'name' => 'nik',
                        'value' => $user->nik,
                    ])
                    @field([
                        'type' => 'text',
                        'label' => 'Email',
                        'name' => 'email',
                        'value' => $user->email,
                    ])
                    @field([
                        'type' => 'select',
                        'label' => 'Lembaga',
                        'name' => 'type_school_id',
                        // 'options' => $type_schools->map(function ($type_school) {
                        // return "<option value='$type_school->id'  selected($type_school->id == $user->type_school->id)>" . $type_school->name . '</option>';
                        //     })->join(' '),
                        'options' => $type_schools->map(function ($type_school) {
                                return "<option value='$type_school->id' >" . $type_school->name . '</option>';
                            })->join(' '),
                    ])
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
