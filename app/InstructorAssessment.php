<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InstructorAssessment extends Model
{
    use SoftDeletes;

    protected $table='instructor_subjects';   

    protected $fillable=['instructor_id','course_type','course_id','class_id','subject_id'];
    

    public function instructorsubject() {
    
        return $this->hasMany(InstructorDaySchedules::class,'instructor_subject_id','id');
    
    }
}
