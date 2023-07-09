<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumniImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row['lembaga'] == 'SMK') {
            $row['lembaga'] = 1;
        } else if ($row['lembaga'] == 'SMA') {
            $row['lembaga'] = 2;
        }
        return User::create([
            'name' => $row['nama'],
            'email' => $row['email'],
            'nik' => strval($row['nik']),
            'type_school_id' => $row['lembaga'] ?? 1,
            'grade_at' => $row['angkatan'],
            'password' => bcrypt($row['nik']),
            'role' => 'ALUMNI',
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required',
            'email' => 'required',
            'nik' => 'required|unique:users',
            'lembaga' => 'required',
            'angkatan' => 'required',
        ];
    }
}
