<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Rekayasa Perangkat Lunak',
                'type_school_id' => 1,
            ],
            [
                'name' => 'Teknik Komputer dan Jaringan',
                'type_school_id' => 1,
            ],
            [
                'name' => 'Broadcasting',
                'type_school_id' => 1,
            ],
            [
                'name' => 'Multimedia',
                'type_school_id' => 1,
            ],
            [
                'name' => 'IPA',
                'type_school_id' => 2,
            ],
            [
                'name' => 'IPS',
                'type_school_id' => 2,
            ],
        ];

        foreach ($data as $d) {
            Major::create($d);
        }
    }
}
