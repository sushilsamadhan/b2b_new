<?php

namespace App\Http\Controllers;

use App\MockTestSection;
use App\MockTestMaster;
use Illuminate\Http\Request;

class MockTestSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $mtestsections = MockTestSection::join('mock_test_masters','mock_test_masters.id','=','mock_test_sections.mock_test_master_id')
                                        ->select('mock_test_masters.name','mock_test_sections.*')
                                        ->orderBy('mock_test_sections.id', 'DESC')->get();
        return view('mtestsections.index',compact('mtestsections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $mocktestmaster = MockTestMaster::get();  
        return view('mtestsections.create',compact('mocktestmaster'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $rules = [
                    'mock_test_master_id'=>'required',
                    'section_name'=>'required',
                    'no_of_question' =>'required',
                    'section_time'=>'required',
                    'question_value'=>'required',
                    'status'=>'required',
                ];

        $customMessages = [
                            'required' => 'The :attribute field is required.'
                        ];

        $this->validate($request, $rules, $customMessages);


        MockTestSection::create([
                                'mock_test_master_id'=>$request->mock_test_master_id,
                                'section_name'=>$request->section_name,
                                'no_of_question'=>$request->no_of_question,
                                'section_time'=>$request->section_time,
                                'question_value'=>$request->question_value,
                                'status'=>$request->status,  
                            ]);

            return redirect()->route('mtestsections.index')
            ->with('success', 'Mock test section created successfully');                                            
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MockTestSection  $mockTestSection
     * @return \Illuminate\Http\Response
     */
    public function show(MockTestSection $mockTestSection,$id)
    {
        //

        $mtestsection = MockTestSection::find($id);
        return view('mtestmasters.edit', compact('mtestsection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MockTestSection  $mockTestSection
     * @return \Illuminate\Http\Response
     */
    public function edit(MockTestSection $mockTestSection,$id)
    {
        $mtestsection   = MockTestSection::where('id','=',$id)->first();                                    
        $mocktestmaster = MockTestMaster::get();
        return view('mtestsections.edit',compact('mocktestmaster','mtestsection'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MockTestSection  $mockTestSection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MockTestSection $mockTestSection)
    {
        //

        $rules = [
                    'mock_test_master_id'=>'required',
                    'section_name'=>'required',
                    'no_of_question' =>'required',
                    'section_time'=>'required',
                    'question_value'=>'required',
                    'status'=>'required',
        ];

        $customMessages = [
                            'required' => 'The :attribute field is required.'
                        ];

        $this->validate($request, $rules, $customMessages);


        MockTestSection::where('id', $request->id)->update([
                                                    'mock_test_master_id'=>$request->mock_test_master_id,
                                                    'section_name'=>$request->section_name,
                                                    'no_of_question'=>$request->no_of_question,
                                                    'section_time'=>$request->section_time,
                                                    'question_value'=>$request->question_value,
                                                    'negative_marking_value'=>$request->negative_marking_value,
                                                    'status'=>$request->status,  
                                                ]);

        return redirect(route('mtestmasters.edit',$request->mock_test_master_id))
                 ->with('success', 'Mock test section updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MockTestSection  $mockTestSection
     * @return \Illuminate\Http\Response
     */
    public function destroy(MockTestSection $mockTestSection,$id)
    {
        //


        $MockTestSection = MockTestSection::where('id', $id)->first();
        $MockTestSection->delete();
        
        return redirect()->back();
    
    }
}
