<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Teacher;

class course extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

       
        $teachers = Teacher::pluck('id')->toArray();

        
        if (empty($teachers)) {
            $this->command->warn('no teacher found ,');
            return;
        }

        $records = [];

        for ($i = 1; $i <= 30; $i++) {
            $records[] = [
                'course_name' => 'Course ' . $i,
                'course_fee'  => $faker->numberBetween(5000, 20000),
                'course_time' => $faker->randomElement(['Morning', 'Afternoon', 'Evening']),
                'description' => $faker->sentence(10),
                'course_code' => 'CSE' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'teacher_id'  => $faker->randomElement($teachers), 
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('courses')->insert($records);
    }
}
