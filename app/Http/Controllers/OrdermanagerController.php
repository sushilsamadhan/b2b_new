<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\OrderDetail;
use App\User;
use App\Model\Enrollment;
use App\UserAddtocartPackage;
use App\Service;
use App\PackageSetting;
use App\Model\CoursePurchaseHistory;
use App\Model\PackagePurchaseHistory;
use App\Model\Course;
use App\Model\Classes;


class OrdermanagerController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $orderDetails = OrderDetail::select('users.id','users.name','order_details.*')
        ->join('users','order_details.user_id','=','users.id')
        ->where('users.user_type', 'Student')
        ->where('users.verified', '1');
        
        if(isset($request->name) && $request->name!='') {
            $orderDetails = $orderDetails->where('users.name', 'like', '%' . $request->name . '%');
        }
        if(isset($request->trans_id) && $request->trans_id!='') {
            $orderDetails = $orderDetails->where('order_details.transaction_id', '=', $request->trans_id);
        }
        $orderDetails = $orderDetails->orderByDesc('order_details.transaction_date') ->paginate(25);
        return view('ordermanager.index', compact('orderDetails'));
    }

     /**
     *
     * @return \Illuminate\Http\Response
     */
    public function orderDetail(Request $request)
    { 
        if(isset($request->id)) {
            $userOrderDetails = OrderDetail::select('users.id as user_id','users.name','order_details.*')
            ->join('users','order_details.user_id','=','users.id')
            ->where('order_details.id', $request->id)
            ->get();

            foreach($userOrderDetails as $value){
                $user_id = $value->user_id;
            }

            if(!empty($user_id)){
                $enrollmentDetails = Enrollment::where('order_detail_id', $request->id)
                ->where('user_id', $user_id)->get();
                return view('ordermanager.detail', compact('userOrderDetails','enrollmentDetails'));
            } else {
                alert(translate('Error'),translate('Invalid order'),'error');
                return back();
            }
        } 
    }
 // To Chapters Data on popup model
    public function chapterDetail($course_id, $packageType, $chapterIds=0)
    {   
     if(!empty($course_id)) {
        $classContent = Classes::join('class_contents','classes.id','class_contents.class_id')
        ->select('classes.id','classes.title','classes.unit')
        ->where('classes.course_id', $course_id)->groupBy('classes.id')->get();

       // $recordCount = $classContent->count();
        return view('ordermanager.chapterdetail', compact('classContent','packageType','chapterIds'));
        }
    }

}
