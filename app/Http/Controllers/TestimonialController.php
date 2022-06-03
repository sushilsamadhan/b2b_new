<?php

namespace App\Http\Controllers;

use App\Model\Testimonial;
use Auth;
use Image;
use Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $testimonials = Testimonial::orderBy('id', 'DESC')->get();

        return view('testimonial.index', compact('testimonials'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('testimonial.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type'=> 'required',
            'title_hi' => 'required',
        ]);
        $testimonial = new Testimonial();
        $testimonial->name = $request->title;
        $testimonial->name_hi = $request->title_hi;
        $testimonial->type = $request->type;
        $testimonial->description = $request->description;
        $testimonial->description_hi = $request->description_hi;
        $testimonial->rating = $request->rating ? $request->rating : 0;
        $testimonial->created_by = Auth::id();
        if ($request->hasFile('image')) {

           // $request->file('image')->store('public');
           
            $testimonial->image = $request->image->store('/thumbnail/testimonial', 'public');
        }
        $testimonial->save();
        return redirect()->route('testimonial.index')
            ->with('success', 'Testimonial created successfully');
    }

    public function show($id) {

        $testimonial = Testimonial::find($id);

        return view('testimonial.edit', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $testimonial = Testimonial::find($id);

        return view('testimonial.edit', compact('testimonial'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // 
        $this->validate($request, [
            'title' => 'required',
            'type'=> 'required',
            'title_hi' => 'required',
        ]);
        $testimonail = Testimonial::find($id);
        $testimonail->name = $request->title;
        $testimonail->name_hi = $request->title_hi;
        $testimonail->type = $request->type;
        $testimonail->rating = $request->rating ? $request->rating : 0;
        $testimonail->description = $request->description;
        $testimonail->description_hi = $request->description_hi;
      
        if (empty($request->image)) {
          //  Storage::disk('public')->delete($testGroup->image);
            $testimonail->image = $testimonail->image;
        }
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($testimonail->image);
            $testimonail->image = $request->image->store('/thumbnail/testimonial','public');
        }
        $testimonail->save();
        return redirect()->route('testimonial.index')
            ->with('success', 'Testimonial updated successfully');
    }

     /**t
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
     //echo "<pre>";print_r($request);die;
        Testimonial::where('id', $request->id)->update(['deleted_by' => Auth::id(), 'deleted_at' => Carbon::now()]);
        
        return redirect()->route('testimonial.index')
        ->with('success', 'Testimonial deleted successfully !');
    }


}
