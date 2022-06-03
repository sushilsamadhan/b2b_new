<?php

namespace App;

//use App\Model\Instructor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class LiveClassSubscription extends Model
{
    use SoftDeletes;

    protected $table='live_class_subscriptions';   

  //  protected $fillable=['instructor_id','instructor_subject_id','live_class_title','date','start_time','end_time','url','status'];
    
    
    // function instructorDetail()
    // {
    //     return $this->belongsTo(Instructor::class,'instructor_id','id');
    // } 

    
}
