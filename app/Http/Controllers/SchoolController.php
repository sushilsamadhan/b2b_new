<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Category;
use Illuminate\Support\Facades\Auth;
use App\Model\Course;
use App\Category_permission;
use App\Course_permission;
use Hash;

class SchoolController extends Controller
{
    
    public function getSchoolData(Request $request)
    {
        $schooldata = DB::table('b2bconfigurations')->where('status',1)->where('universities_id',$request->schoolId)->first();
        return response()->json($schooldata);
    }
    
        public function index()
        {
        if(Auth::user()->id != "5"){    
            $id = Auth::user()->school_id; 
            $school = DB::table('universities')->where('id',$id)->where('deleted_at',NULL)->first();          
            $schooldata = DB::table('b2bconfigurations')->where('universities_id',$id)->first();
            $b2bconfigrationpermition = DB::table('b2bconfigration_permissions')->where('slug',$schooldata->slug)->first();
            return view('school.b2bconfiguration',compact('schooldata','b2bconfigrationpermition','school','id'));
        }else{
            if(isset($_GET['search'])){
                $school = DB::table('universities')
                ->where('university_name', 'like', '%' . $request->search . '%')
                ->orWhere('contact_person_number', 'like', '%' . $request->search . '%')
                ->where('deleted_at',NULL)->paginate(10);
            }else{
                $school = DB::table('universities')->where('deleted_at',NULL)
                ->paginate(10);
            }
            return view('school.index',compact('school'));
        }
    }

    public function create(Request $request)
    {
        return view('school.create');
    }


    public function B2BCategoryPermissions(Request $request)
    {
       $id = $request->id;
       $school = DB::table('universities')->where('id',$id)->where('deleted_at',NULL)->first();

       $existcategory = Category_permission::select('category_id')->where('school_id', $id)->get();

       // $categories = Category::where('is_item','0')->with('child')->orderBy('sequence','asc')->Published()->get();

       return view('school.b2b_permission',compact('id','existcategory','school'));
    }
    
    public function B2BCategoryPermissionsAdd(Request $request)
    {
        // print_r($_POST); die;
        if($request->school_id != ''){
            Category_permission::where('school_id', $request->school_id)->where('main_category', $request->main_category)->delete();
            if($request->main_category=='folk-programme'){
                $values = array(
                    'category_id' => $request->main_category,
                    'school_id' => $request->school_id,
                    'type' => $request->main_category, 
                    'main_category' => $request->main_category
                 );
            if($request->category=='yes'){
                DB::table('category_permissions')->insert($values);
            }
                return redirect()->route('school.B2B.category.permissions',$request->school_id)->with('success',"School permissions Updated Successfully!");
            }
            $values = array(
                            'category_id' => $request->main_category,
                            'school_id' => $request->school_id,
                            'type' => $request->main_category, 
                            'main_category' => $request->main_category
                         );
            
                DB::table('category_permissions')->insert($values);
            if($request->p_category){
                foreach($request->p_category as $p_categoryval){
                    $values = array('category_id' => $p_categoryval,'school_id' => $request->school_id,'type' => 'p_category', 'main_category' => $request->main_category);
                    if($p_categoryval=='Documentry'){
                        $values['p_category'] = 'Documentry'; 
                    }
                    if($p_categoryval=='Project-Report'){
                        $values['p_category'] = 'Project-Report'; 
                    }
                    if($p_categoryval=='EDP-courses'){
                        $values['p_category'] = 'EDP-courses'; 
                    }
                    if($p_categoryval=='STUDY-MATERIAL'){
                        $values['p_category'] = 'STUDY-MATERIAL'; 
                    }
                    if($p_categoryval=='project-work'){
                        $values['p_category'] = 'project-work'; 
                    }
                    DB::table('category_permissions')->insert($values);
                }
                if($request->s_category){
                    foreach($request->s_category as $s_categoryval){
                        $values = array('category_id' => $s_categoryval,'school_id' => $request->school_id,'type' => 's_category', 'main_category' => $request->main_category);
                        DB::table('category_permissions')->insert($values);
                    }
                }
            }else{
                Category_permission::where('school_id', $request->school_id)->where('main_category', $request->main_category)->delete();
            }
        }
            return redirect()->route('school.B2B.category.permissions',$request->school_id)->with('success',"School permissions Updated Successfully!");
    }


    // public function getForPermission(Request $request){
    //     $coursesdata = Course::Published()->where('category_id', $request->id)->get();
    //     return view('school.forpermission',compact('coursesdata'));
    // }

    public function getForPermission(Request $request){
        $school_id = $request->school_id; 
        if($request->id=="school"){
            $school_pcategory = DB::table('system_settings')->select('value')->where('type','school_pcategory_permission')->first(); 
            return view('school.forpermission',compact('school_pcategory','school_id'));
        }
        if($request->id=="collage"){
            $school_pcategory = DB::table('system_settings')->select('value')->where('type','college_pcategory_permission')->first(); 
            return view('school.forCollagepermission',compact('school_pcategory','school_id'));
        }
        if($request->id=="competitive"){
            $school_pcategory = DB::table('system_settings')->select('value')->where('type','competitive_pcategory_permission')->first(); 
            return view('school.forCollagepermission',compact('school_pcategory','school_id'));
        }
        if($request->id=="folk-programme"){
        if(\App\Category_permission::where('school_id', $school_id)->where('type', 'folk-programme')->where('category_id', 'folk-programme')->exists()){
                $checked = ' checked ';
        }else{
                $checked = '';
        }
            echo '<div class="form-group col-md-3">
                    <div class="form-check">
                        <label class="form-check-label" for="defaultCheck-folk-programme">Folk Programme</label>
                        <input '.$checked.' style="margin-left:20px;" class="form-check-input checkBoxClass" type="checkbox" value="yes" id="defaultCheck-folk-programme" name="category">   
                    </div>
                 </div>';
        }   
        if($request->id=="entrepreneur"){

            // $school_pcategory = DB::table('system_settings')->select('value')->where('type','entrepreneur_pcategory_permission
            // ')->first(); 
            return view('school.forEntrepreneurpermission',compact('school_id'));
        }


        
        // $coursesdata = Course::Published()->where('category_id', $request->id)->get();
        // return view('school.forpermission',compact('coursesdata'));
    }


    public function b2bpricing_mechanism(Request $request)
    {
        $id = $request->id;
        $school = DB::table('universities')->where('id',$id)->where('deleted_at',NULL)->first();
 
        $existMechanism = DB::table('b2bpricing_mechanisms')->select('*')->where('school_id',$id)->first();
        // $categories = Category::where('is_item','0')->with('child')->orderBy('sequence','asc')->Published()->get();
 
        return view('school.pricing_mechanism',compact('id','school','existMechanism'));
    }

    public function b2bmeta_configration(Request $request)
    {
        $id = $request->id;
        $school = DB::table('universities')->where('id',$id)->where('deleted_at',NULL)->first();
 
        $metaConfig = DB::table('b2bconfigurations')->select('*')->where('universities_id',$id)->first();
        // $categories = Category::where('is_item','0')->with('child')->orderBy('sequence','asc')->Published()->get();
 
        return view('school.metaConfiguration',compact('id','school','metaConfig'));
    }

    public function b2bmeta_configrationAdd(Request $request)
    {
        $data = array(
            'meta_title' => $request->meta_title, 
            'meta_description' => $request->meta_description, 
            'tag' => $request->tag, 
            'keywords' => $request->keywords
        );
        if($request->hasFile('fav_icon')){
            $image = $request->file('fav_icon');
            $ext = $image->extension();
            $new_image = time().".".$ext;
            $destinationPath = public_path('/uploads/b2bconfigurationslogo');
            $image->move($destinationPath, $new_image);
            $new_image_name='uploads/b2bconfigurationslogo/'.$new_image;
            $new_image_name = url('public').'/'.$new_image_name;
            $data['fav_icon'] = $new_image_name;
        }
        $school = DB::table('b2bconfigurations')->where('universities_id',$request->school_id)->update($data);

        return redirect()->route('school.b2bmeta_configration',$request->school_id)->with('success',"School Meta Configration Updated Successfully!");

    }


    public function b2bpricing_mechanismAdd(Request $request)
    {
        $request->validate([
            'mechanisms_type' => 'required',
            'value' => 'required',
          ], 
          [
            'mechanisms_type.required' => 'The Mechanisms Type field is required.',
            'value.required' => 'The value Field is required.',
        ]);

        $values = array('school_id' => $request->school_id, 'mechanisms_type' => $request->mechanisms_type, 'value' => $request->value);

        $existMechanism = DB::table('b2bpricing_mechanisms')->select('*')->where('school_id',$request->school_id)->exists();
        if($existMechanism){
            DB::table('b2bpricing_mechanisms')->where('school_id', $request->school_id)->update($values);
        }else{
            DB::table('b2bpricing_mechanisms')->insert($values);
        }


        return redirect()->route('school.b2bpricing_mechanism',$request->school_id)->with('success',"School Pricing Mechanism Updated Successfully!");
    }
    












    

    public function add(Request $request)
    {
        
        $validator = $request->validate([
        'university_name' => 'required',
        'contact_person_name' => 'required',
        'contact_person_email' => 'required',
        'contact_person_number' => 'required|digits:10|numeric|unique:universities',
        'address' => 'required',
        'pincode' => 'required|digits:6|numeric',
        'state' => 'required',
        'city' => 'required',
        'status' => 'required',
        'logo' => 'required|mimes:jpeg,png,jpg',
        ],
        [
        'university_name.required' => 'Institute name required',
        'contact_person_name.required' => 'Contact Person name is required',
        'contact_person_email.required' => 'Contact Person email is required',
        'contact_person_number.required' => 'Contact Person mobile is required',
        'contact_person_number.numeric' => 'Contact Person mobile should be numeric',
        'contact_person_number.unique' => 'Contact Person mobile sholud be unique',
        'address.required' => 'Address is required',
        'pincode.required' => 'Pincode is required',
        'state.required' => 'State is required',
        'city' => 'City is required',
        'status.required' => 'Status is required',
        'logo.required' => 'Logo is required',
        ]);

        $data = [
            'university_name' => $request->input('university_name'),
            'contact_person_name' => $request->input('contact_person_name'),
            'contact_person_email' => $request->input('contact_person_email'),
            'contact_person_number' => $request->input('contact_person_number'),
            'address' => $request->input('address'),
            'pincode' => $request->input('pincode'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'status' => $request->input('status'),
            'branch' => $request->input('branch'),
        ];

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $ext = $image->extension();
            $new_image = time().".".$ext;
            $image->move('public/school/logo/',$new_image);
            $data['logo'] = $new_image;
        }
        

        $school = DB::table('universities')->insert($data);
        if($school){
            return redirect()->route('school.index')->with('success',"School Created Successfully!");
        }
    }

    public function destroy(Request $request)
    {
        $id = base64_decode($request->id);    
        $data['deleted_at'] = now();
        $data['status'] = '0';
        $school = DB::table('universities')->where('id',$id)->update($data);
        if($school){
            return redirect()->route('school.index')->with('success',"School Deleted Successfully!");
        }
    }

    public function edit(Request $request)
    {
        $id = base64_decode($request->id);    
        $school = DB::table('universities')->where('id',$id)->first();
        return view('school.edit',compact('school'));
    }

    public function b2bconfigurations(Request $request)
    {
        $id = $request->id;   
        $school = DB::table('b2bconfigurations')->where('universities_id',$id)->first();
        $universitie = DB::table('universities')->where('id',$id)->first();

        // print_r($b2bconfigrationpermition); die;
        
        if($school){
            $schooldata = $school;
            $b2bconfigrationpermition = DB::table('b2bconfigration_permissions')->where('slug',$school->slug)->first();
            return view('school.b2bconfiguration',compact('schooldata','b2bconfigrationpermition','universitie','id'));
        }elseif($universitie){
            $values = array('universities_id' => $id);
            DB::table('b2bconfigurations')->insert($values);
        }
       
       $schooldata = DB::table('b2bconfigurations')->where('universities_id',$id)->first();

       $b2bconfigrationpermition = DB::table('b2bconfigration_permissions')->where('slug',$schooldata->slug)->first();
       if(!$b2bconfigrationpermition){
            $values = array('slug' => $schooldata->slug);
            DB::table('b2bconfigration_permissions')->insert($values);
            $b2bconfigrationpermition = DB::table('b2bconfigration_permissions')->where('slug',$schooldata->slug)->first();
        }
       return view('school.b2bconfiguration',compact('schooldata','b2bconfigrationpermition','universitie'));
    }
    public function b2bconfigurationsAddpermition(Request $request){
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
    public function b2bconfigurationsAdd(Request $request){
        $id = $request->univercityId;  
        // print_r($_POST);  die;
        $data = [
            'slug' => $request->input('slug'),
            'domain_name' => $request->input('domain_name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'passwordplanetest' => $request->input('password'),
            'subscription' => $request->input('subscription'),
            'mou_date' => $request->input('mou_date'),
            'mou_term' => $request->input('mou_term'),
            'commission' => $request->input('commission'),
            // 'theme_configration' => $request->input('theme_configration'),
            'slug' => $request->input('slug'),
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
    }
    public function checkslug(Request $request){
        $schooldata = DB::table('b2bconfigurations')->where('slug',$request->slug)->where('universities_id','!=',$request->universities_id)->first();
        if($schooldata){
            return 1;
        }else{
            return 0; 
        }
    }
    public function update(Request $request)
    {
        $id = $request->id;    
       $data = [
            'university_name' => $request->input('university_name'),
            'contact_person_name' => $request->input('contact_person_name'),
            'contact_person_email' => $request->input('contact_person_email'),
            'contact_person_number' => $request->input('contact_person_number'),
            'address' => $request->input('address'),
            'pincode' => $request->input('pincode'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'status' => $request->input('status'),
            'branch' => $request->input('branch'),
        ];

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $ext = $image->extension();
            $new_image = time().".".$ext;
            $image->move('public/school/logo/',$new_image);
            $data['logo'] = $new_image;
        }

        $school = DB::table('universities')->where('id',$id)->update($data);
        if($school){
            return redirect()->route('school.index')->with('success',"School Updated Successfully!");
        }
    }

    
    public function getCoursesForPermision(Request $request){
        // echo $request->category_id; die;
        $Course = Course::select('*')->where('user_id','5')
            ->where('content_type', $request->content_type)
            ->where('category_id', $request->category_id)->get();

        print_r($Course);
        die('=============');
    }
}
