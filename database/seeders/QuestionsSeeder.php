<?php

namespace Database\Seeders;

use App\Models\Questions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Questions::create([
            'evaluation_id' => 1,
            'question' => 'Cuanto es 1 + 1',
            'multiple' => true,
        ]);
        
        Questions::create([
            'evaluation_id' => 1,
            'question' => 'Cuanto es 3 + 1',
            'multiple' => true,
        ]);
        
        Questions::create([
            'evaluation_id' => 1,
            'question' => 'Cuanto es 7 + 2',
            'multiple' => true,
        ]);
        
        Questions::create([
            'evaluation_id' => 1,
            'question' => 'Que es una suma',
            'multiple' => false,
        ]);
    }
}
