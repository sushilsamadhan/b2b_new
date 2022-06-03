<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use SoftDeletes;

    protected $table = "new_sliders";
}
