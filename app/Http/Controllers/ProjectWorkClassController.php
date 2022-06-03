<?php

namespace App\Http\Controllers;

//use App\ProjectWorkClass;
use App\Model\PwClasses;
use Illuminate\Http\Request;

class ProjectWorkClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $projectworkclass = PwClasses::orderBy('id', 'DESC')->paginate(20);
   //    echo '<pre>'; print_r($projectworkclass);exit;  
        return view('projectworkclasses.index', compact('projectworkclass'))
        ->with('i',(request()->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projectworkclasses.create');

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
                        'class_title'=>'required',
                   //     'status'=>'required',
                        
                    ];

            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];

            $this->validate($request, $rules, $customMessages);
            PwClasses::create([
                                'title'             =>  $request->class_title,
                         //       'status'                  =>  $request->status,
                            ]);

            return redirect()->route('projectworkclasses.index')
            ->with('success', 'Project Work Classes created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectWorkClass  $projectWorkClass
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectWorkClass $projectWorkClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProjectWorkClass  $projectWorkClass
     * @return \Illuminate\Http\Response
     */
    public function edit(PwClasses $projectWorkClass,$id)
    {
        //
        $projectworkclass = PwClasses::find($id);
        return view('projectworkclasses.edit', compact('projectworkclass'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectWorkClass  $projectWorkClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PwClasses $projectWorkClass)
    {
        //
        $rules = [
            'class_title'=>'required',
         //   'status'=>'required',
            
        ];

            $customMessages = [
                'required' => 'The :attribute field is required.'
            ];

            $this->validate($request, $rules, $customMessages);

            PwClasses::where('id',$request->id)->update([
                                'title'             =>  $request->class_title,
                            //    'status'                  =>  $request->status,
                            ]);

            return redirect()->route('projectworkclasses.index')
            ->with('success', 'Project Work Classes updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectWorkClass  $projectWorkClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(PwClasses $projectWorkClass,$id)
    {
        //

        $projectWorkClass = PwClasses::where('id','=',$id)->first();
        $projectWorkClass->delete();
        
        return redirect()->route('projectworkclasses.index')
                         ->with('success', 'Project Work Classes deleted successfully !');

    }
}
