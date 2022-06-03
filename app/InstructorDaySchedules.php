<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class InstructorDaySchedules extends Model
{
    use SoftDeletes;

    protected $table='instructor_day_schedules';   

    protected $fillable=['instructor_subject_id','day','start_time','end_time'];
    
}
