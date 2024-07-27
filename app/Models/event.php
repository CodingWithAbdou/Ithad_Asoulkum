<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar',
        'title_en',
        'note_ar',
        'note_en',
        'phone',
        'date',
        'place_ar',
        'place_en',
        'type_ar',
        'type_en',
    ];
}
