<?php

namespace Database\Seeders;

use App\Models\Answers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answers::create([
            'question_id' => 1,
            'answer' => '3',
            'correct' => false
        ]);
        
        Answers::create([
            'question_id' => 1,
            'answer' => '2',
            'correct' => true
        ]);
        
        Answers::create([
            'question_id' => 1,
            'answer' => '23',
            'correct' => false
        ]);
        
        Answers::create([
            'question_id' => 1,
            'answer' => '4',
            'correct' => false
        ]);
        
        
        Answers::create([
            'question_id' => 2,
            'answer' => '3',
            'correct' => false
        ]);
        
        Answers::create([
            'question_id' => 2,
            'answer' => '4',
            'correct' => true
        ]);
        
        Answers::create([
            'question_id' => 2,
            'answer' => '16',
            'correct' => false
        ]);
        
        Answers::create([
            'question_id' => 2,
            'answer' => '5',
            'correct' => false
        ]);
        
        
        Answers::create([
            'question_id' => 2,
            'answer' => '12',
            'correct' => false
        ]);
        
        Answers::create([
            'question_id' => 2,
            'answer' => '9',
            'correct' => true
        ]);
        
        Answers::create([
            'question_id' => 2,
            'answer' => '10',
            'correct' => false
        ]);
        
        Answers::create([
            'question_id' => 2,
            'answer' => '8',
            'correct' => false
        ]);
    }
}
