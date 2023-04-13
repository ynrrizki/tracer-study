<?php

namespace App\Imports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\Importable;
// use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MajorImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        // dd($row);
        if ($row['lembaga_smasmk'] == 'SMK') {
            $row['lembaga_smasmk'] = 1;
        } else if ($row['lembaga_smasmk'] == 'SMA') {
            $row['lembaga_smasmk'] = 2;
        }
        return Major::create([
            'name' => $row['nama_jurusan'],
            'type_school_id' => $row['lembaga_smasmk'] ?? 1,
            'expired_year' => $row['tahun_pergantian'],
        ]);
    }
}
