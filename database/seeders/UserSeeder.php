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

        $data = [
            [
                'name'      => 'Admin',
                'email'     => 'admin@gmail.com',
                'password'  => bcrypt('admin'),
                'role'     => 'ADMIN',
            ],
            [
                'name'      => 'Mikhael Khosea',
                'nik'       => '31750167890123453',
                'password'  => bcrypt('31750167890123453'),
                'email'     => 'mikha@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2021',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Ida Bagus Yogesvara',
                'nik'       => '31750167890123452',
                'password'  => bcrypt('31750167890123452'),
                'email'     => 'yoges@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2022',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Yanuar Rizki Sanjaya',
                'nik'       => '31750167890123451',
                'password'  => bcrypt('31750167890123451'),
                'email'     => 'yanuarrizki165@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Adi Susilo',
                'nik'       => '3175037890123455',
                'password'  => bcrypt('31750167890123451'),
                'email'     => 'adi@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Nazhmi Dwiputra Effendi',
                'nik'       => '3175037890123456',
                'password'  => bcrypt('3175037890123456'),
                'email'     => 'nazhmi@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Henokh Rudolf',
                'nik'       => '3175047890123456',
                'password'  => bcrypt('3175047890123456'),
                'email'     => 'henokh@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Boni Steven',
                'nik'       => '3175057890123456',
                'password'  => bcrypt('3175057890123456'),
                'email'     => 'boni@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Tasya Ramadhinta',
                'nik'       => '3175067890123456',
                'password'  => bcrypt('3175067890123456'),
                'email'     => 'tasyarkh@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Naufal Firmansyah',
                'nik'       => '3175068890123456',
                'password'  => bcrypt('3175068890123456'),
                'email'     => 'naufal@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Faishal Bushoiri',
                'nik'       => '3175069890123456',
                'password'  => bcrypt('3175069890123456'),
                'email'     => 'faishal@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Muhammad Syawaludin',
                'nik'       => '3175027890123456',
                'password'  => bcrypt('3175027890123456'),
                'email'     => 'syawal@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Romy',
                'nik'       => '3175027810123456',
                'password'  => bcrypt('3175027810123456'),
                'email'     => 'romy@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Virgiawan',
                'nik'       => '3175060890223456',
                'password'  => bcrypt('3175060890223456'),
                'email'     => 'virgi@gmail.com',
                'type_school_id' => 2,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Editya',
                'nik'       => '3175060890123456',
                'password'  => bcrypt('3175060890123456'),
                'email'     => 'edit@gmail.com',
                'type_school_id' => 2,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Aisyah',
                'nik'       => '3175061890123456',
                'password'  => bcrypt('3175061890123456'),
                'email'     => 'icha@gmail.com',
                'type_school_id' => 2,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
            [
                'name'      => 'Verasta',
                'nik'       => '3175061890123476',
                'password'  => bcrypt('3175061890123476'),
                'email'     => 'verasta@gmail.com',
                'type_school_id' => 1,
                'grade_at' => '2023',
                'role'     => 'ALUMNI',
            ],
        ];

        foreach ($data as $row) {
            User::create($row);
        }

        // User::create([
        //     'name'      => 'Yanuar Rizki Sanjaya',
        //     'nik'       => '12345',
        //     'password'  => bcrypt('12345'),
        //     'email'     => 'yanuarrizki165@gmail.com',
        //     'type_school_id' => 1,
        //     'role'     => 'ALUMNI',
        // ]);

        // User::create([
        //     'name'      => 'Didit',
        //     'nik'       => '22222',
        //     'password'  => bcrypt('22222'),
        //     'email'     => 'didit@gmail.com',
        //     'type_school_id' => 2,
        //     'role'     => 'ALUMNI',
        // ]);
        // User::create([
        //     'name'      => 'Admin',
        //     'email'     => 'admin@gmail.com',
        //     'password'  => bcrypt('admin'),
        //     'role'     => 'ADMIN',
        // ],);
    }
}
