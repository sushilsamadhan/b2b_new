<?php

namespace App\Http\Controllers\ReportManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Coupon;
use App\OrderDetail;
use App\Model\Enrollment;
use App\Model\Course;
use App\PackageSetting;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*All Coupons with search option */
    public function index(Request $request)
    {
        if($request->start_date!=''){ 
            $request->start_date = $request->start_date.' '.'00:00:00';
        } else {
            $request->start_date = date('2021-01-01 00:00:00');
        }
        if($request->end_date!='') {
            $request->end_date = $request->end_date.' '.'23:59:59.000000';
        } else {
            $request->end_date = date('Y-m-d H:i:s');
        }

        $dateFrom   = date('d-m-Y', strtotime($request->start_date));
        $dateTo     = date('d-m-Y', strtotime($request->end_date));

        $coupon_order_details = DB::table('coupons')
                                    ->select('coupons.code','coupons.discount_type','coupons.rate','order_details.transaction_amount','order_details.discount_amount', DB::raw('COUNT(order_details.coupon_code) AS total_count'), DB::raw('SUM(order_details.transaction_amount) AS total_order'),DB::raw('SUM(order_details.discount_amount) AS total_discount'))
                                    ->join('order_details','order_details.coupon_code','=','coupons.code')
                                    ->where(function($query) {
                                        $query->where('order_details.transaction_status','=','SUCCESS')
                                            ->orWhere('order_details.transaction_status','=','FREE');
                                        })
                                    ->whereBetween('order_details.created_at', [$request->start_date, $request->end_date])
                                    ->groupBy('coupons.code')->paginate(25);

        return view('module.coupon_usage_summary.index',compact('coupon_order_details','dateFrom','dateTo'));
    }

    public function couponCode(Request $request)
    {
        if($request->start_date!=''){ 
            $request->start_date = $request->start_date.' '.'00:00:00';
        } else {
            $request->start_date = date('2021-01-01 00:00:00');
        }
        if($request->end_date!='') {
            $request->end_date = $request->end_date.' '.'23:59:59.000000';
        } else {
            $request->end_date = date('Y-m-d H:i:s');
        }

        $dateFrom   = date('d-m-Y', strtotime($request->start_date));
        $dateTo     = date('d-m-Y', strtotime($request->end_date));
        
        if($request->code){
            $coupon_code = $request->code;
           $order_details = OrderDetail::where('coupon_code',$coupon_code)
                            ->whereBetween('transaction_date', [$request->start_date, $request->end_date])
                           ->orderBy('created_at','desc')->paginate(50);
           return view('module.coupon_usage_summary.coupon_detail',compact('order_details','dateFrom','dateTo'));
       }
    }

    public function getCourse(Request $request) {

        $uid = $request->id;
        $code = $request->code;

        $userDetails = Enrollment::select('enrollments.id','enrollments.course_id',
                        'enrollments.package_id','order_details.coupon_code')
                        ->join('order_details', 'order_details.user_id', '=','enrollments.user_id')
                        ->join('course_purchase_histories', 'course_purchase_histories.enrollment_id', '=','enrollments.id')
                        ->join('user_addtocart_packages', 'user_addtocart_packages.enrollment_id', '=','enrollments.id')
                        ->where('enrollments.user_id',$uid)
                        ->where('order_details.coupon_code',$code)
                        ->groupBy('enrollments.id')
                        ->get();  

        return view('module.coupon_usage_summary.course',compact('userDetails'));
    }

    public static function getPackageDetails($package_id){
        $courses     = PackageSetting::select('package_settings.pkg_name',
                        'user_addtocart_packages.total_amount', 'user_addtocart_packages.discount_price')
                        ->join('user_addtocart_packages', 'user_addtocart_packages.package_id','=','package_settings.id')
                        ->where('package_settings.id',$package_id)
                        ->groupBy('package_settings.id')->first();
        return $courses->pkg_name.'|'. $courses->total_amount.'|'. $courses->discount_price;             
    }

    public static function getCourseDetails($package_id){
        $coureses   = Course::select('title','price','discount_price')
                        ->where('id',$course_id)->groupBy('id')->first();
        return $courses->title.'|'. $courses->price.'|'. $courses->discount_price;
    }

}
