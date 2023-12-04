<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentCourses extends Model
{
    use HasFactory;

    protected $table = 'student_courses';
    protected $fillable = [
        'student_id',
        'course_id'
    ];

    public function students() : BelongsTo
    {
        return $this->belongsTo(Students::class, 'student_id');
    }

    public function courses() : BelongsTo
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
