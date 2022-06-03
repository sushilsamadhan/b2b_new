<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MindMap extends Model
{
    //
    protected $fillable = ['mind_map_title','course_id','class_id','class_content_id','mind_map_file_url','sequence','user_id'];

}
