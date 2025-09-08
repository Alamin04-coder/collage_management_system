<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Userseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
       public function run(): void
    {
    //     $records = [];

    //     for ($i = 1; $i <= 500; $i++) {
    //         $records[] = [
    //             'name'            => 'Student '.$i,
    //             'user_id'         => rand(1, 49), 
    //             'session'         => '2023-2024',
    //             'department'      => 'Computer Science',
    //             'class_roll'      => 'CS'.str_pad($i, 3, '0', STR_PAD_LEFT),
    //             'board_roll'      => 'BR'.rand(10000, 99999),
    //             'registration_no' => 'REG'.str_pad($i, 4, '0', STR_PAD_LEFT),
    //             'shift'           => 'Morning',
    //         ];
    //     }

    //     DB::table('students')->insert($records);
    // }

    // {
     $tole = ['student', 'admin', 'teacher'];

$records = [];
for ($i = 1; $i < 50; $i++) {
    $records[] = [
        'email' => $i.'avb@gmai.com',
        'password' => bcrypt('123'.$i),
        'role' => $tole[array_rand($tole)],
        'name' => 'User'.$i,
    ];
}

DB::table('users')->insert($records);
    }
}