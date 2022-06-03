<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PwSeenContent extends Model
{
    protected $fillable = [
        'email', 'token'
    ];
}
