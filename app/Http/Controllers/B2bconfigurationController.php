<?php

namespace App\Http\Controllers;

use App\B2bconfiguration;
use Illuminate\Http\Request;
use Hash;
use Redirect;
use Session;
use DB;

class B2bconfigurationController extends Controller
{
    public function universitylogin()
    {
        return view('auth.universitylogin');
    }

    public function universityloginnow(Request $request)
    {
        $univercityExist = B2bconfiguration::where(['username'=>$request->slug])->first();
        if($univercityExist){
            if($univercityExist->universities_id==Session::get('school_id')){
                if ($univercityExist && Hash::check($request->password, $univercityExist->password)){
                    Session::put('university_id', $univercityExist->universities_id);
                    return redirect('university-dashboard');
                }else{
                    return back()->with('wrongpass','Wrong Password');  
                }
            }else{
                return back()->with('message','This is not your site');  
            }
        }else{
            return back()->with('wronguser','User name password not currect');
        }
    }
    public function indexDashboard()
    {
        if(Session::get('university_id')){
            return view('universityDashboard.index');
        }else{
            return redirect('university-login');
        }
    }
    public function schoolIndex()
    {
        if(Session::get('university_id')){
            $id = Session::get('university_id');               
            $schooldata = DB::table('b2bconfigurations')->where('universities_id',$id)->first();
            $b2bconfigrationpermition = DB::table('b2bconfigration_permissions')->where('slug',$schooldata->slug)->first();
           return view('universityDashboard.schoolconfig',compact('schooldata','b2bconfigrationpermition'));
        }else{
            return redirect('university-login');
        }
    }
    public function schoolconfigurationsAdd(Request $request)
    {
        if(Session::get('university_id') && $request->univercityId==Session::get('university_id')){
            $id = $request->univercityId;  
            // print_r($_POST);  die;
            $data = [
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'passwordplanetest' => $request->input('password'),
                'domain_name' => $request->input('domain_name'),
                'subscription' => $request->input('subscription'),
                'mou_date' => $request->input('mou_date'),
                'mou_term' => $request->input('mou_term'),
                'commission' => $request->input('commission'),
                // 'theme_configration' => $request->input('theme_configration'),
                'status' => $request->input('status')
            ];
            if(isset($_POST['theme_configration']))
            $data = [
                 'theme_configration' => $request->input('theme_configration')
             ];
    
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $ext = $image->extension();
                $new_image = time().".".$ext;
                $destinationPath = public_path('/uploads/b2bconfigurationslogo');
                $image->move($destinationPath, $new_image);
                $new_image_name='uploads/b2bconfigurationslogo/'.$new_image;
                $new_image_name = url('public').'/'.$new_image_name;
                $data['logo'] = $new_image_name;
            }
            $school = DB::table('b2bconfigurations')->where('universities_id',$id)->update($data);
            // if($school){
                return back()->with('success','B 2 B Configurations Successfully!');
            // }
        }else{
            return redirect('university-login');
        }
    } 
    public function schoolconfigurationsAddpermition(Request $request){
        $b2bconfigration = DB::table('b2bconfigration_permissions')->where('slug',$request->slug)->first();
        if(!$b2bconfigration){
            $values = array(
                'slug' => $request->slug,
                'silder_area' => $request->silder_area,
                'special_banners' => $request->special_banners,
                'category_area' => $request->category_area,
                'free_live_course' => $request->free_live_course,
                'pricing_area' => $request->pricing_area,
                'curriculum_promo' => $request->curriculum_promo,
                'affiliate_program' => $request->affiliate_program,
                'competitive_classes_area' => $request->competitive_classes_area,
                'test_series_program' => $request->test_series_program,
                'study_for_free' => $request->study_for_free,
                'top_online_instructors' => $request->top_online_instructors,
                'what_student_says' => $request->what_student_says,
                'blog_area' => $request->blog_area
            );
            DB::table('b2bconfigration_permissions')->insert($values);
        }else{
            $values = array(
                'slug' => $request->slug,
                'silder_area' => $request->silder_area,
                'special_banners' => $request->special_banners,
                'category_area' => $request->category_area,
                'free_live_course' => $request->free_live_course,
                'pricing_area' => $request->pricing_area,
                'curriculum_promo' => $request->curriculum_promo,
                'affiliate_program' => $request->affiliate_program,
                'competitive_classes_area' => $request->competitive_classes_area,
                'test_series_program' => $request->test_series_program,
                'study_for_free' => $request->study_for_free,
                'top_online_instructors' => $request->top_online_instructors,
                'what_student_says' => $request->what_student_says,
                'blog_area' => $request->blog_area
            );
            DB::table('b2bconfigration_permissions')->where('slug',$request->slug)->update($values);
        }
        return back()->with('success','B 2 B Configurations Successfully!');
    
    }
}
