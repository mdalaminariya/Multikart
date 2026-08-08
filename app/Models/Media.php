<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    Use HasFactory;
     protected $fillable = [
        'file_name',
        'image',
        'url',
    ];
}
