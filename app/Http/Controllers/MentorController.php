<?php

namespace App\Http\Controllers;

use App\Model\Mentor;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        return view('mentor.index');
    }
     public function mentorValidation(Request $request)
    {  
        $this->validate( $request, [
            'name' => 'required|string',
            'phone' => 'required|string',                        
            'experience' => 'required|string',
            'profile_desc' => 'required|string',                        
            'profile_title' => 'required|string'
        ],
        [ 
            'name.required' => 'Please Enter Your valid title ',
            'profile_title.required' => 'Please Enter Your valid title ',
            'experience.required' => 'Please Enter Your valid experience ',
            'profile_desc.required' => 'Please Enter Your valid discription '                        

        ]); 

        $data = new Mentor();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->experience = $request->experience;
        $data->profile_title = $request->profile_title;
        $data->profile_desc = $request->profile_desc;
               
        if($request->has('photo')){
            $photo = $request->file('photo');
            $ext = $photo->extension();
            $new_image = time().".".$ext;
            $photo->move(public_path('mentor_images/'),$new_image);
            $data->photo = 'mentor_images/'.$new_image;
        }
        $data->save();
        return redirect("/add-mentor")->withSuccess('Mentor Added succesfully');       
                

    }

    public function mentorView()
    {
        $mentorsData = Mentor::all();
        return view('mentor.list_mentor',compact('mentorsData'));
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data = Mentor::find($id);
        if($data->status == 1){
            $data1['status'] = 0;
            Mentor::where('id',$id)->update($data1);
            return response(['message' => translate('Status is Active ')], 200);
        }else{
            $data1['status'] = 1;
            Mentor::where('id',$id)->update($data1);
        return response(['message' => translate('Status is Inactive ')], 200);
        }
    }
            
    public function listDetail($id)
    {      
        $item = Mentor::find($id);        
        return view('mentor.detail',compact('item'));
    }

    public function edit($id)
    {
        $item = Mentor::findOrFail($id);
        return view('mentor.edit', compact('item'));
        
    }

    public function update(Request $request,$id)
    {
        $this->validate( $request, 
        [
            'name' => 'required|string',
            'phone' => 'required|string',                        
            'experience' => 'required|string',
            'profile_desc' => 'required|string',                        
            'profile_title' => 'required|string'
        ],
        [ 
            'name.required' => 'Please Enter Your valid title ',
            'profile_title.required' => 'Please Enter Your valid title ',
            'experience.required' => 'Please Enter Your valid experience ',
            'profile_desc.required' => 'Please Enter Your valid discription '                        
        
        ]);
        $data = [
             'name' => $request->input('name'),
             'phone' => $request->input('phone'),
             'experience' => $request->input('experience'),
             'profile_title' => $request->input('profile_title'),
             'profile_desc' => $request->input('profile_desc'),
        ]; 
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $ext = $image->extension();
            $new_image = time().".".$ext;
            $image->move('public/mentor_images/',$new_image);
            $data['photo'] = 'mentor_images/'.$new_image;
        }
        $mentor = Mentor::where('id',$id)->update($data);
        if($mentor){
            return redirect("list-mentor")->withSuccess('Mentor updated succesfully');  
        }
    }
   
}
