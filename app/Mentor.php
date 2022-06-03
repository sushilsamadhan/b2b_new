<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    protected $table='mentors'; 
    protected $fillable = [
        'name',
        'phone',
        'experience',
        'photo',
        'profile_title',
        'profile_desc',
        'status',
        
    ];
}
