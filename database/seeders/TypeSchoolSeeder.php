<?php

namespace Database\Seeders;

use App\Models\TypeSchool;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeSchool::create([
            'name' => 'SMK',
        ]);

        TypeSchool::create([
            'name' => 'SMA',
        ]);
    }
}
