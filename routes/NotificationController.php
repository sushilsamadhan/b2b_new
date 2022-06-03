<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sliders = Notification::orderBy('id', 'DESC')->get();
     
        return view('notification.index', compact('sliders'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users  = User::get();

        return view('notification.create', compact('users'));
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
            'user' =>'required'
        ]);

        $slider = new Notification();
        $slider->title = $request->title;
        $slider->user_id = $request->user;
        $slider->description = $request->description;
        $slider->created_at = Auth::id();
        if ($request->hasFile('image')) {
            $slider->image = $request->image->store('thumbnail/notification', 'public');
        }
        $slider->save();


        return redirect()->route('admin-notification.index')
            ->with('success', 'Notification created successfully');
    }

    public function show($id) {
        $slider = Notification::find($id);

        return view('notification.edit', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Notification::find($id);
        $users  = User::get();
		
        return view('notification.edit', compact('slider','users'));
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
            'user' =>'required',
        ]);

        $slider = Notification::find($id);
        $slider->title = $request->title;
        $slider->user_id = $request->user;
        $slider->description = $request->description;
        if (empty($request->image)) {

            $slider->image = $slider->image;
        }
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $slider->image = $request->image->store('thumbnail/notification', 'public');
        }
        $slider->save();

        return redirect()->route('admin-notification.index')
            ->with('success', 'Notification updated successfully');
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
        Notification::where('id', '=', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->route('admin-notification.index')
                ->with('success','Notification deleted successfully');
    }
}
