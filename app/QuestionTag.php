<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTag extends Model
{
    //
    protected $fillable   =[
        'ques_cat_id',
        'tag_name',
        'parent_tag_id',
        'status'
    ];
}
