<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'      => 'melanjutkan',
        ]);

        Category::create([
            'name'      => 'bekerja',
        ]);

        Category::create([
            'name'      => 'freelance',
        ]);

        Category::create([
            'name'      => 'general',
        ]);

        Category::create([
            'name'      => 'feedback',
        ]);
    }
}
