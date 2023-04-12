<?php

namespace App\Imports;

use App\Models\Major;
// use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class MajorImport implements ToModel
{
    /**
     * @param Collection $collection
     */
    public function model(array $row)
    {
        if ($row[1] == 'SMK') {
            $row[1] = 1;
        } else if ($row[1] == 'SMA') {
            $row[1] = 2;
        }
        return Major::create([
            'name' => $row[0],
            'type_school_id' => $row[1] ?? 1,
            'expired_year' => $row[2],
        ]);
    }
}
