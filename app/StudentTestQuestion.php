<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentTestQuestion extends Model
{
    //
    protected $fillable = ['q_tag_type_id','unit_id','chapter_id','q_cat_id','sub_cat_id','course_id','category_id','question_categorie_id','level_id','body','solution','q_tag','parent_id','question_type','question_tag_id','user_id'];
}