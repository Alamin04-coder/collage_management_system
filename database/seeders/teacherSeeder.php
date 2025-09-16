<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $departments = ['Computer Science', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'English', 'History'];
        $specializations = ['AI', 'Networking', 'Data Science', 'Machine Learning', 'Web Development', 'Cyber Security', 'Database'];
        $genders = ['Male', 'Female', 'Other'];

        $records = [];

        
        $totalTeachers = 100; 

        for ($i = 90; $i <= $totalTeachers; $i++) {
            $records[] = [
                'name'           => 'Teacher '.$i,
                'user_id'        => rand(1, 49), 
                'teacher_id'     => 'TI'.str_pad($i, 2, '1', STR_PAD_LEFT), 
                'phone'          => '01'.rand(100000000, 999999999),
                'gender'         => $genders[array_rand($genders)],
                'dob'            => Carbon::now()->subYears(rand(25, 50))->format('Y-m-d'),
                'department'     => $departments[array_rand($departments)],
                'specialization' => $specializations[array_rand($specializations)],
                'image'          => null,
                'join_date'      => Carbon::now()->subYears(rand(0, 10))->format('Y-m-d'),
                'address'        => 'Address of Teacher '.$i,
                
            ];
        }

        DB::table('teachers')->insert($records);
    }
}
