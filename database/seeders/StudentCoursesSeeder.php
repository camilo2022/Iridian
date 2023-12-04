<?php

namespace Database\Seeders;

use App\Models\StudentCourses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentCourses::create(['student_id' => 1, 'course_id' => 1]);
        StudentCourses::create(['student_id' => 2, 'course_id' => 1]);
        StudentCourses::create(['student_id' => 3, 'course_id' => 1]);
    }
}
