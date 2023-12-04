<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Requests\Evaluations\EvaluationsStoreRequest;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StudentsSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(StudentCoursesSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(AnswersSeeder::class);
        $this->call(StudentQuestionAnswerSeeder::class);
        $this->call(ContactAreasSeeder::class);
    }
}
