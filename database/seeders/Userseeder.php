<?php

namespace Database\Seeders;

 use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;



class Userseeder extends Seeder
{
 
  public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
           
            $user = User::create([
                'name' => 'Student ' . $i,
                'email' => 'student' . $i . '@example.com',
                'password' => Hash::make('password'), 
                'role' => 'student',
            ]);

           
            Student::create([
                'name'            => 'Student ' . $i,
                'user_id'         => $user->id, 
                'session'         => '2023-2024',
                'department'      => 'Computer Science',
                'class_roll'      => 'CS' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'board_roll'      => 'BR' . rand(10000, 99999),
                'registration_no' => 'REG' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'shift'           => 'Morning',
            ]);
        }
    }
}
