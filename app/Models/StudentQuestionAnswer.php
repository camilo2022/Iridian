<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function students() : BelongsTo
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function questions() : BelongsTo
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }

    public function answers() : BelongsTo
    {
        return $this->belongsTo(Answers::class, 'answer_id');
    }
}
