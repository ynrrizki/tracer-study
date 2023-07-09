@extends('layouts.dash')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h3 class="card-header">{{ $alumni->name }}</h3>
                <div class="card-body">
                    {{-- <p class="mb-0">
                        <strong class="mr-1">NIK :</strong>{{ $alumni->nik }}
                    </p>
                    <p class="mb-0">
                        <strong class="pr-1">Jurusan :</strong>{{ $alumni->personalData->major->name ?? '-' }}
                    </p>
                    <p class="mb-0">
                        <strong class="pr-1">Alamat :</strong>{{ $alumni->personalData->address ?? '-' }}
                    </p>
                    <p class="mb-0">
                        <strong class="pr-1">
                            No HP :
                        </strong>{{ $alumni->personalData->phone ?? '-' }}
                    </p>
                    <p class="mb-0">
                        <strong class="pr-1">
                            Tanggal Lahir:
                        </strong>{{ $alumni->personalData->birth_date ?? '-' }}
                    </p> --}}
                    <table>
                        <tbody>
                            <tr>
                                <td><strong>NIK</strong></td>
                                <td><strong> : </strong></td>
                                <td>{{ $alumni->nik }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jurusan</strong></td>
                                <td><strong> : </strong></td>
                                <td>{{ $alumni->personalData->major->name ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td><strong> : </strong></td>
                                <td>{{ $alumni->personalData->address ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>No HP</strong></td>
                                <td><strong> : </strong></td>
                                <td>{{ $alumni->personalData->phone ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir</strong></td>
                                <td><strong> : </strong></td>
                                <td>{{ $alumni->personalData->birth_date ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Account -->
                <hr class="my-0">
                <div class="card-body">
                    <h4>Survey</h4>
                    <div class="row mb-5">
                        @foreach ($surveyQuestions as $key => $question)
                            @foreach ($alumni->answers as $answer)
                                @if ($question->id == $answer->question_id)
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">{{ $question->name }}</label>
                                        <input class="form-control" type="text" value="{{ $answer->fill ?? '-' }}">
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <h4>Feedback</h4>
                    <div class="row">
                        @foreach ($feedBackQuestions as $key => $question)
                            @foreach ($alumni->answers as $answer)
                                @if ($question->id == $answer->question_id)
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">{{ $question->name }}</label>
                                        <input class="form-control" type="text" value="{{ $answer->fill ?? '-' }}">
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <!-- /Account -->
            </div>

        </div>
    </div>
@endsection
