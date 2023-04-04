<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Question::create([
            'category_id' => 4,
            'type_input_id' => 4,
            'name'      => 'Status',
        ]);

        // 2
        Question::create([
            'category_id' => 4,
            'type_input_id' => 1,
            'name'      => 'Nama Instansi Tempat Kerja / Kuliah',
        ]);

        // 3
        Question::create([
            'category_id' => 4,
            'type_input_id' => 1,
            'name'      => 'Kesesuaian Jurusan dengan Tempat Bekerja / Kuliah',
        ]);

        // 1
        Question::create([
            'category_id' => 5,
            'type_input_id' => 1,
            'name'      => 'Secara umum, bagaimana kepuasan Anda terhadap pembelajaran SMK?',
        ]);
    }
}