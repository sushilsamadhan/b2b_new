<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model\Enrollment;
class OrderDetail extends Model
{
    //
    protected $fillable = ['user_id','order_total','discount_amount','coupon_id','coupon_code',
                            'is_refund','refund_amount','transaction_id','transaction_amount',
                            'transaction_status','transaction_date','transaction_type','transaction_mode'];
    public function orderedCourses()
    {
        return $this->hasMany(Enrollment::class, 'order_detail_id', 'id');
    }
}
