<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = [
        'name',
        'description',
    ];

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(Students::class, 'student_courses', 'course_id', 'student_id');
    }

    public function evaluations() : HasMany
    {
        return $this->hasMany(Evaluations::class, 'course_id');
    }
}
