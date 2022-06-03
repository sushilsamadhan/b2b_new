<?php

namespace App\Http\Controllers\ReportManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Model\Student;
use App\User;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;

class UserRegistrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*All Registered users with search option */
    public function index(Request $request)
    {
        if($request->start_date!=''){ 
            $request->start_date = $request->start_date.' '.'00:00:00';
        } else {
            $request->start_date = date('2021-01-01 00:00:00');
        }
        if($request->end_date!=''){
            $request->end_date = $request->end_date.' '.'23:59:59.000000';
        } else {
            $request->end_date = date('Y-m-d H:i:s');
        }

        $dateFrom   = date('d-m-Y', strtotime($request->start_date));
        $dateTo     = date('d-m-Y', strtotime($request->end_date));

        $reports = DB::select(DB::raw("SELECT COUNT(users.id) AS Total_users 
                        ,COUNT(students.id) AS Total_students
                        ,SUM(CASE WHEN students.class_type = 'k12' THEN 1 ELSE 0 END) AS Academic
                        ,SUM(CASE WHEN students.class_type = '18+' THEN 1 ELSE 0 END) AS Competitive
                        ,SUM(CASE WHEN students.class_type IS NULL THEN 1 ELSE 0 END) AS OtherStudents
                        ,SUM(CASE WHEN users.device = 'Android' THEN 1 ELSE 0 END) AS Android
                        ,SUM(CASE WHEN users.device = 'Desktop' THEN 1 ELSE 0 END) AS Desktop
                        ,SUM(CASE WHEN users.device IS NULL THEN 1 ELSE 0 END) AS OtherUsers
                        FROM users INNER JOIN students ON (users.id = students.user_id)
                        WHERE students.deleted_at IS NULL AND users.user_type ='Student'
                        AND students.created_at BETWEEN '".$request->start_date."' and '".$request->end_date."'"));
        
        return view('module.reportmanager.index',compact('reports','dateFrom','dateTo'));
    }

    // Academic Revenue
    public function academicRevenue(Request $request) {
        if($request->start_date!=''){ 
            $request->start_date = $request->start_date.' '.'00:00:00';
        } else {
            $request->start_date = date('2021-01-01 00:00:00');
        }
        if($request->end_date!=''){
            $request->end_date = $request->end_date.' '.'23:59:59.000000';
        } else {
            $request->end_date = date('Y-m-d H:i:s');
        }

        $dateFrom   = date('d-m-Y', strtotime($request->start_date));
        $dateTo     = date('d-m-Y', strtotime($request->end_date));

        // $users = User::select('users.id')
        //                 ->join('students','students.user_id','=','users.id')
        //                 ->where('students.class_type', '=', 'k12')
        //                 ->get();

        // $u_id = array();
        // foreach ($users as $data) {
        //     array_push($u_id, $data->id);
        // }

        // $academic   =  DB::table("order_details")
        //                     ->select(DB::raw("SUM(order_total) as total"))
        //                     ->whereIn('user_id', array_unique($u_id))
        //                     ->whereBetween('created_at', [$request->start_date, $request->end_date])
        //                     ->get();

        $academic = User::select(DB::raw("SUM('order_details.order_total') as total"))
                            ->join('students','students.user_id','=','users.id')
                            ->join('enrollments','enrollments.user_id','=','students.user_id')
                            ->join('order_details','order_details.user_id','=','enrollments.user_id')
                            ->where('students.class_type', '=', 'k12')
                            ->whereBetween('order_details.created_at', [$request->start_date, $request->end_date])
                            ->groupBy('users.id')
                            ->get();    

        $total  =  $academic[0]->total;
        return view('module.reportmanager.academic_revenue',compact('total','dateFrom','dateTo'));
    }

    // Competitive Revenue
    public function competetiveRevenue(Request $request) {
        if($request->start_date!=''){ 
            $request->start_date = $request->start_date.' '.'00:00:00';
        } else {
            $request->start_date = date('2021-01-01 00:00:00');
        }
        if($request->end_date!=''){
            $request->end_date = $request->end_date.' '.'23:59:59.000000';
        } else {
            $request->end_date = date('Y-m-d H:i:s');
        }

        $dateFrom   = date('d-m-Y', strtotime($request->start_date));
        $dateTo     = date('d-m-Y', strtotime($request->end_date));

        // $users = User::select('users.*')
        //               //  ->addSelect(DB::raw("SUM(order_details.order_total) as total"))
        //                 ->join('students1','students.user_id','=','users.id')
        //                 ->join('enrollments','enrollments.user_id','=','users.id')
        //                 ->join('order_details','order_details.user_id','=','enrollments.user_id')
        //                 ->where('students.class_type', '=', '18+')
        //                 ->whereBetween('order_details.created_at', [$request->start_date, $request->end_date])
        //                 ->get();

        $comptetive = User::select(DB::raw("SUM('order_details.order_total') as total"))
        ->join('students','students.user_id','=','users.id')
        ->join('enrollments','enrollments.user_id','=','students.user_id')
        ->join('order_details','order_details.user_id','=','enrollments.user_id')
        ->where('students.class_type', '=', '18+')
        ->whereBetween('order_details.created_at', [$request->start_date, $request->end_date])
        ->groupBy('users.id')
        ->get();

        // $u_id = array();
        // foreach ($users as $data) {
        //     array_push($u_id, $data->id);
        // }

        // $comptetive   =  DB::table("order_details")
        //                 ->select(DB::raw("SUM(order_total) as total"))
        //                 ->whereIn('user_id', array_unique($u_id))
        //                 ->whereBetween('created_at', [$request->start_date, $request->end_date])
        //                 ->get();

     //   echo '<pre>'; print_r($comptetive);

        $total  =  $comptetive[0]->total; 
        return view('module.reportmanager.competitive_revenue',compact('total','dateFrom','dateTo'));
    }

}
