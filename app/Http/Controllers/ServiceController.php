<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $services = Service::orderBy('id', 'DESC')->get();
        //print_r($); die;

        return view('service.index', compact('services'));
    }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('service.create');
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
            'service_name' => 'required',
            'status' =>'required',

        ]);
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->status = $request->status;
        $service->save();

        return redirect()->route('service.index')
            ->with('success', 'Service created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
            
        return view('service.edit', compact('service'));
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
            'service_name' => 'required',
            'status' => 'required',
        ]);
        $service = Service::find($id);
        $service->service_name = $request->service_name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->status = $request->status;
        $service->save();

        return redirect()->route('service.index')->with('success', 'Service updated successfully');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy(Service $service,$id)
    {
        //
        Service::where('id', '=', $id)->update(['deleted_at' => Carbon::now()]);
        return redirect()->route('service.index')
                ->with('success','Service deleted successfully');
    }
   

}
