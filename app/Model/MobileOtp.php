<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileOtp extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];
}
