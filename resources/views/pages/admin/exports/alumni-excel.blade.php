<table>
    <thead>
        <tr>
            <th style="text-align: center; font-weight: bold; border: 5px solid orange;" colspan="8">Data Diri</th>
            <th style="text-align: center; font-weight: bold; border: 5px solid blue;" colspan="{{ count($survey) }}">
                Pertanyaan Survey</th>
            <th style="text-align: center; font-weight: bold; border: 5px solid red;" colspan="{{ count($feedback) }}">
                Pertanyaan FeedBack</th>
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
            @foreach ($survey as $question)
                <th>
                    {{ $question->name }}
                </th>
            @endforeach
            @foreach ($feedback as $question)
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
                @foreach ($survey as $question)
                    @foreach ($alumni->answers as $answer)
                        @if ($answer->question_id == $question->id)
                            <td>
                                {{ $answer->fill ?? '-' }}
                            </td>
                        @endif
                    @endforeach
                @endforeach
                @foreach ($feedback as $question)
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
