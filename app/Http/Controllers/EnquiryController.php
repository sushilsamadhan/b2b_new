<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enquiry;

class EnquiryController extends Controller
{
    public function connecteachers()
    {

       
        return view('connect_teacher.index');
    }

    public function connecteachers_validate_us(Request $request)
    {  
       

        $request->validate([
            'name' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'phone' => 'required|digits:10|unique:enquiries,phone',
            'email' => 'required|email|unique:enquiries,email',
            'qualification' => 'required|string',
            'subject' => 'required|string',
            'day' => 'required|string',
            'starttime' => 'required',
            'endtime' => 'required',
            'location' => 'required|string',
            'pincode' => 'required|digits:6',
            'city' => 'required|string',
            'State' => 'required|string',    
        ],
        [ 'name.required' => 'Please Enter Your valid Name ',
        'phone.required' => 'Please Enter Your valid phone No. ',
        'email.required' => 'Please Enter Your valid Email ',
        'qualification.required' => 'Please Enter Your Qualification ',
        'subject.required' => 'Please Enter Your subject Name ',
        'day.required' => 'Please select Your day ',
        'starttime.required' => 'start Time is Required',
        'endtime.required' => 'End Time is Required',
        'location.required' => 'Please Enter Your location Address ',
        'pincode.required' => 'Please Enter Your valid pincode ',
        'city.required' => 'Please Enter Your valid Name ',
        'State.required' => 'Please Enter Your valid Name ',
    ],
    );
       
        DB::table('enquiries')->insert([
            
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'qualification' => $request->qualification,
            'subject' => $request->subject,
            'day' => $request->day,
            'starttime' => $request->starttime,
            'endtime' => $request->endtime,
            'location' => $request->location,
            'pincode' => $request->pincode,
            'city' => $request->city,
            'State' => $request->State
        
        ]);
        return redirect("/become-tutor")->withSuccess('YRequest submitted successfully.');
    }

    public function enquiry_data_index()
    {
        $enquiry = Enquiry::all();
        return view('enquiry.index', compact('enquiry'));
    }

}
