<?php

namespace Database\Seeders;

use App\Models\StudentQuestionAnswer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentQuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentQuestionAnswer::create([
            'student_id' => 1,
            'question_id' => 1,
            'answer_id' => 2,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 1,
            'question_id' => 2,
            'answer_id' => 6,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 1,
            'question_id' => 3,
            'answer_id' => 10,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 1,
            'question_id' => 4,
            'answer_id' => null,
            'answer' => 'sumar'
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 2,
            'question_id' => 1,
            'answer_id' => 1,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 2,
            'question_id' => 2,
            'answer_id' => 6,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 2,
            'question_id' => 3,
            'answer_id' => 10,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 2,
            'question_id' => 4,
            'answer_id' => null,
            'answer' => 'no se'
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 3,
            'question_id' => 1,
            'answer_id' => 1,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 3,
            'question_id' => 2,
            'answer_id' => 5,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 3,
            'question_id' => 3,
            'answer_id' => 12,
            'answer' => null
        ]);

        StudentQuestionAnswer::create([
            'student_id' => 3,
            'question_id' => 4,
            'answer_id' => null,
            'answer' => 'no se'
        ]);
    }
}
