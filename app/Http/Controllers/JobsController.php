<?php

namespace App\Http\Controllers;

use App\JobsData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;

class JobsController extends Controller
{
    public function jobsIndex()
    {       
        return view('job.add_job');
    }
    public function jobValidation(Request $request)
    {  
          $this->validate( $request, [
            'title' => 'required|string',
            'short_discription' => 'required|string',
            'discription' => 'required|string',
            'catagry_ids' => 'required|string'  
        ],
        [ 
            'title.required' => 'Please Enter Your valid title ',
            'short_discription.required' => 'Please Enter Your valid short_discription ',
            'discription.required' => 'Please Enter Your valid discription ',
            'catagry_ids.required' => 'Please Enter Your valid catagry_ids ',
        
    ]); 


    
     $jobs = new JobsData();
     $jobs->title = $request->title;
     $jobs->short_discription = $request->short_discription;
     $jobs->discription = $request->discription;
     $jobs->source_url = $request->source_url;

     if($request->has('image')){
         $image = $request->file('image');
         $ext = $image->extension();
         $new_image = time().".".$ext;
         $image->move(public_path('job_images/'),$new_image);
         $jobs->image =$new_image;
     }
     $jobs->catagry_ids = $request->catagry_ids;
     $jobs->save();

           
        return redirect("/add_new_jobs")->withSuccess('inserted data succesfully');       
    

}

public function listIndex()
    {     
        $jobsdata = JobsData::paginate(12);
        return view('job.job_list', compact('jobsdata'));  
       
    }
    

    public function jobsfullIndex($id)
    {       
        $item = JobsData::findOrFail($id);
        return view('job.job_index', compact('item'));
    }

    public function jobEdit($id)
    {       
        $item = JobsData::findOrFail($id);
        return view('job.job_edit', compact('item'));
    }

    public function jobUpdate(Request $request,$id){


        $this->validate( $request, [
            'title' => 'required|string',
            'short_discription' => 'required|string',
            'discription' => 'required|string',
            'catagry_ids' => 'required|string'  
        ],
        [ 
            'title.required' => 'Please Enter Your valid title ',
            'short_discription.required' => 'Please Enter Your valid short_discription ',
            'discription.required' => 'Please Enter Your valid discription ',
            'catagry_ids.required' => 'Please Enter Your valid catagry_ids ',
        
    ]); 
    $title = $request->title;
    $short_discription = $request->short_discription;
    $discription = $request->discription;
    $source_url = $request->source_url;
    
    $jobs = new JobsData();
    $new_image = NULL;
    if($request->has('image')){
        $image = $request->file('image');
        $ext = $image->getClientOriginalExtension();
        $new_image = time().".".$ext;
        $image->move(public_path('job_images/'),$new_image);

    }
    



    $catagry_ids = $request->catagry_ids;

    DB::update('update jobs_datas set title = ?,short_discription=?,discription=?,source_url=?,image=?,catagry_ids=? where id = ?',[$title,$short_discription,$discription,$source_url,$new_image,$catagry_ids,$id]);
   

    return redirect("/job_Edit/{$id}")->withSuccess('inserted data succesfully'); 

    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data = JobsData::find($id);
        if($data->status == 1){
            $data1['status'] = 0;
        }else{
            $data1['status'] = 1;
        }

        $result = JobsData::where('id',$id)->update($data1);
        return response(['message' => translate('Status is Change ')], 200);
        //echo $data->is_display;
    }

    public function listjobIndex()
    {     
        $jobsdata = DB::table('jobs_datas')->select()->where('status','=','0')->paginate(24);
        // $jobsdata = Jobs_data::paginate(24);
        return view('rumbok.homepage.job_notification', compact('jobsdata'));  
       
    }

    public function job_notification_details($jobid)
    {
        $id = base64_decode($jobid);
       // die('=====');
       $item = DB::table('jobs_datas')->select()->where('id',$id)->where('status','=','0')->first();
       return view('rumbok.homepage.job_notification_details', compact('item'));
     
    }
   
}
