<?php

namespace Database\Seeders;

use App\Models\Evaluations;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluations::create([
            'course_id' => 1,
            'name' => 'Suma',
            'date' => Carbon::now()->format('Y-m-d'),
        ]);
    }
}
