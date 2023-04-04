<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class AlumniImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd([
        //     'name' => $row[0],
        //     'email' => $row[1],
        //     'nis' => strval($row[2]),
        //     'password' => Hash::make($row[2]),
        // ]);
        if ($row[3] == 'SMK') {
            $row[3] = 1;
        } else if ($row[3] == 'SMA') {
            $row[3] = 2;
        }
        return User::create([
            'name' => $row[0],
            'email' => $row[1],
            'nik' => strval($row[2]),
            'type_school_id' => $row[3] ?? 1,
            'password' => bcrypt($row[2]),
            'role' => 'ALUMNI',
        ]);
        // User::create([
        //     'name'      => 'Didit',
        //     'nis'       => '22222',
        //     'password'  => bcrypt('22222'),
        //     'email'     => 'didit@gmail.com',
        //     'role'     => 'ALUMNI',
        // ]);
    }
}
