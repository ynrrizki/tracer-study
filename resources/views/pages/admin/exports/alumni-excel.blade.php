<table>
    <thead>
        <tr>
            <th style="text-align: center; font-weight: bold" colspan="7">Data Diri</th>
            <th style="text-align: center; font-weight: bold" colspan="{{ count($questions) }}">Pertanyaan Survey</th>
        </tr>
        <tr>
            <th>
                Name
            </th>
            <th>
                NIK
            </th>
            <th>
                Email
            </th>
            <th>
                Alamat
            </th>
            <th>
                No HP
            </th>
            <th>
                Tanggal Lahir
            </th>
            <th>
                Jurusan
            </th>
            <th>
                Lembaga
            </th>
            @foreach ($questions as $question)
                <th>
                    {{ $question->name }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($alumnus as $alumni)
            <tr>
                <td>
                    {{ $alumni->name }}
                </td>
                <td>
                    {{ $alumni->nik }}
                </td>
                <td>
                    {{ $alumni->email }}
                </td>
                <td>
                    {{ $alumni->personalData->address ?? '' }}
                </td>
                <td>
                    {{ $alumni->personalData->phone ?? '' }}
                </td>
                <td>
                    {{ $alumni->personalData->birth_date ?? '' }}
                </td>
                <td>
                    {{ $alumni->personalData->major->name ?? '' }}
                </td>
                <td>
                    {{ $alumni->typeSchool->name ?? '' }}
                </td>
                @foreach ($questions as $question)
                    @foreach ($alumni->answers as $answer)
                        @if ($answer->question_id == $question->id)
                            <td>
                                {{ $answer->fill ?? '-' }}
                            </td>
                        @endif
                    @endforeach
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
