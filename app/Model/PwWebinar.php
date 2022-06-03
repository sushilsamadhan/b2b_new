<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PwWebinar extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function webinarDetail()
    {
        return $this->hasOne(Webinar::class,'id','webinar_id');
    }
    //END
}
