<?php

namespace Database\Seeders;

use App\Models\TypeInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        TypeInput::create([
            'name'      => 'text',
        ]);
        // 2
        TypeInput::create([
            'name'      => 'select',
        ]);
        // 3
        TypeInput::create([
            'name'      => 'checkbox',
        ]);
        // 4
        TypeInput::create([
            'name'      => 'radio',
        ]);
        // 5
        TypeInput::create([
            'name'      => 'date',
        ]);
    }
}
