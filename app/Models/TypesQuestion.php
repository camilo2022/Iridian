<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypesQuestion extends Model
{
    use HasFactory;
    
    protected $table = 'types_questions';
    protected $fillable = [
        'name',
        'multiple',
    ];
}
