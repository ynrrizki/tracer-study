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
                Jurusan
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
                    {{ $alumni->personalData->major->name ?? '' }}
                </td>
                <td>
                    {{ $alumni->personalData->major->address ?? '' }}
                </td>
                <td>
                    {{ $alumni->personalData->major->phone ?? '' }}
                </td>
                <td>
                    {{ $alumni->personalData->major->birth_date ?? '' }}
                </td>
                @foreach ($alumni->answers as $answer)
                    <td>
                        {{ $answer->fill ?? '-' }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>