<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Questions extends Model
{
    use HasFactory;

    protected $table = 'questions';
    protected $fillable = [
        'evaluation_id',
        'question',
        'multiple',
    ];

    public function answers() : HasMany
    {
        return $this->hasMany(Answers::class, 'question_id');
    }

    public function evaluation() : BelongsTo
    {
        return $this->belongsTo(Evaluations::class, 'evaluation_id');
    }
}
