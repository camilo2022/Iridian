<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers';
    protected $fillable = [
        'question_id',
        'answer',
        'correct'
    ];

    public function question() : BelongsTo
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }
}
