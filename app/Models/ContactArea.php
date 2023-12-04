<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactArea extends Model
{
    use HasFactory;

    protected $table = 'contact_areas';
    protected $fillable = [
        'name',
    ];
}
