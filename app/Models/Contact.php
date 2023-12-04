<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'phone',
        'contact_area_id',
        'message'
    ];

    public function contact_area() : BelongsTo
    {
        return $this->belongsTo(ContactArea::class, 'contact_area_id');
    }
}
