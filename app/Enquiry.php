<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'qualification',
        'subject',
        'day',
        'starttime',
        'endtime',
        'location',
        'pincode',
        'city',
        'State',
        'type',
        
    ];
}
