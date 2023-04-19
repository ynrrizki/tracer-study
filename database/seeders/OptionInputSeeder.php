<?php

namespace Database\Seeders;

use App\Models\OptionInput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionInputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Status
        OptionInput::create([
            'question_id' => 1,
            'name'      => 'Bekerja',
        ]);

        OptionInput::create([
            'question_id' => 1,
            'name'      => 'Kuliah',
        ]);

        OptionInput::create([
            'question_id' => 1,
            'name'      => 'Wirausaha (Freelance/Online)',
        ]);

        OptionInput::create([
            'question_id' => 3,
            'name' => 'Sesuai',
        ]);

        OptionInput::create([
            'question_id' => 3,
            'name' => 'Tidak Sesuai',
        ]);
    }
}
