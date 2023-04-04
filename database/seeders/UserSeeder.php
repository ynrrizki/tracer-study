<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Yanuar Rizki Sanjaya',
            'nik'       => '12345',
            'password'  => bcrypt('12345'),
            'email'     => 'yanuarrizki165@gmail.com',
            'type_school_id' => 1,
            'role'     => 'ALUMNI',
        ]);

        User::create([
            'name'      => 'Didit',
            'nik'       => '22222',
            'password'  => bcrypt('22222'),
            'email'     => 'didit@gmail.com',
            'type_school_id' => 2,
            'role'     => 'ALUMNI',
        ]);
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('admin'),
            'role'     => 'ADMIN',
        ],);
    }
}
