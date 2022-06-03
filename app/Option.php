<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $fillable=['question_id','passage_question_id','option_title','flag_correct'];
}
