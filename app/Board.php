<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    protected $table='boards';  
    protected $fillable=['name','slug','board','board_state','description','is_popular','top','icon','is_published'];
}
