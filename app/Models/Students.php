<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Students extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'students';
    protected $fillable = [
        'name',
        'lastname',
        'document',
        'phone',
        'birth_date',
        'email'
    ];

    public function courses() : BelongsToMany
    {
        return $this->belongsToMany(Courses::class, 'student_courses', 'student_id', 'course_id');
    }

    public function questions() : BelongsToMany
    {
        return $this->belongsToMany(Questions::class, 'student_question_answers', 'student_id', 'question_id');
    }

    public function answers() : BelongsToMany
    {
        return $this->belongsToMany(Answers::class, 'student_question_answers', 'student_id', 'answer_id');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%' . $search . '%')
        ->orWhere('lastname', 'like', '%' . $search . '%')
        ->orWhere('document', 'like', '%' . $search . '%')
        ->orWhere('phone', 'like', '%' . $search . '%')
        ->orWhere('birth_date', 'like', '%' . $search . '%')
        ->orWhere('email', 'like', '%' . $search . '%');
    }
}
