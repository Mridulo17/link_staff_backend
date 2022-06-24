<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAttachPost extends Model
{
    use HasFactory; 
    protected $fillable = [
        'person_id',
        'details'
    ];
}
