<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentQuestionAnswer extends Model
{
    use HasFactory;

    protected $table = 'student_question_answers';
    protected $fillable = [
        'student_id',
        'question_id',
        'answer_id',
        'answer'
    ];
}
