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

        // সব teachers এর id নিয়ে আসি
        $teachers = Teacher::pluck('id')->toArray();

        // যদি teacher না থাকে তাহলে warning দেখাই
        if (empty($teachers)) {
            $this->command->warn('⚠️ Please seed teachers before seeding courses.');
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
                'teacher_id'  => $faker->randomElement($teachers), // valid teacher_id
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('courses')->insert($records);
    }
}
