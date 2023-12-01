<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Evaluations extends Model
{
    use HasFactory;

    protected $table = 'evaluations';
    protected $fillable = [
        'course_id',
        'name',
        'date',
    ];

    public function questions() : HasMany
    {
        return $this->hasMany(Questions::class, 'evaluation_id');
    }
}
