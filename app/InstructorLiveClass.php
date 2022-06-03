<?php

namespace App;

use App\Model\Instructor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InstructorLiveClass extends Model
{
    use SoftDeletes;

    protected $table='instructor_live_classes';   

    protected $fillable=['instructor_id','instructor_subject_id','live_class_title','date','start_time','end_time','url','status'];
    
    
    function instructorDetail()
    {
        return $this->belongsTo(Instructor::class,'instructor_id','id');
    }
    function instructorSubjectDetail()
    {
        return $this->belongsTo(InstructorAssessment::class,'instructor_subject_id','id');
    } 

    
}
