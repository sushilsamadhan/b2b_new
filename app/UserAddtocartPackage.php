<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddtocartPackage extends Model
{
    //
    protected $fillable   =[
                            'user_id',
                            'package_id',
                            'package_type',
                            'service_id',
                            'course_id',
                            'total_amount',
                            'discount_price',
                            'status'
                        ];
}
