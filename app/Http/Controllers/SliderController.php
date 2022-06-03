<?php

namespace App\Http\Controllers;

use App\Slider;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class SliderController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = Slider::orderBy('id', 'DESC')->where('school_id', '=', Auth::user()->school_id)->get();

        return view('slider.index', compact('sliders'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create');
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
            'image' => 'required',
            'type' =>'required'
        ]);
        $slider = new Slider();
        $slider->name = $request->title;
        $slider->school_id = Auth::user()->school_id;
        $slider->type = $request->type;
        $slider->url = $request->url;
        $slider->created_by = Auth::id();
        if ($request->hasFile('image')) {
            $slider->image = $request->image->store('thumbnail/slider', 'public');
        }
        $slider->save();

        return redirect()->route('slider.index')
            ->with('success', 'Media created successfully');
    }

    public function show($id) {
        $slider = Slider::where('school_id', '=', Auth::user()->school_id)->find($id);

        return view('slider.edit', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::where('school_id', '=', Auth::user()->school_id)->find($id);
		//print_r($slider); die;
        return view('slider.edit', compact('slider'));
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
        $this->validate($request, [
            'title' => 'required',
            'type' =>'required',
        ]);

        $slider = Slider::find($id);
        $slider->name = $request->title;
        $slider->school_id = Auth::user()->school_id;
        $slider->type = $request->type;
        $slider->url = $request->url;
        if (empty($request->image)) {

            $slider->image = $slider->image;
        }
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $slider->image = $request->image->store('thumbnail/slider', 'public');
        }
        $slider->save();

        return redirect()->route('slider.index')
            ->with('success', 'Media updated successfully');
    }

     /**t
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // public function destroy(Request $request)
    // {
     
    //     Slider::where('id', $request->step_id)->update(['deleted_by' => Auth::id(), 'deleted_at' => Carbon::now()]);
        
    //     return redirect()->route('slider.index')
    //     ->with('success', 'Media deleted successfully !');
    // }
    public function destroy($id)
    {
        //
        Slider::where('id', '=', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->route('slider.index')
                ->with('success','Media deleted successfully');
    }
}
