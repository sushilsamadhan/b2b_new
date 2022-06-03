<?php

namespace App\Http\Controllers\Webinar;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Exception;
use App\Model\Webinar;
use App\Model\PwWebinar;
use Auth;
use Alert;
use Carbon\Carbon;
use App\NotificationUser;
use Illuminate\Support\Facades\DB;


class WebinarController extends Controller
{

    function userNotify($user_id,$details)
    {
        $notify = new NotificationUser();
        $notify->user_id = $user_id;
        $notify->data = $details;
        $notify->save();
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    /*only instructor show only his/her webinars
     Admin can show all Webinars
    */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            if (Auth::user()->user_type == "Admin") {
                $webinars = Webinar::where('topic', 'like', '%' . $request->search . '%')              
                ->latest()->paginate(10)->withQueryString();
            } else {
                $webinars = Webinar::where("user_id", Auth::id())
                ->where('topic', 'like', '%' . $request->search . '%')
                ->latest()->paginate(10)->withQueryString();
            }
        } else {
            if (Auth::user()->user_type == "Admin") { 
                $webinars = Webinar::latest()->paginate(10)->withQueryString();
            } else { 
                $webinars = Webinar::where("user_id", Auth::id())->latest()->paginate(10)->withQueryString();
            }
        }
        return view('webinar.index', compact('webinars'));
    }

    // webinar.create
    public function create()
    {
        return view('webinar.create');
    }

    // webinar.store
    public function store(Request $request)
    {
        if (env('DEMO') === "YES") {
            Alert::warning('warning', 'This is demo purpose only');
            return back();
        }
        $request->validate([
            'topic' => 'required',
            'image' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'topic_description' => 'required',
            'recorded_video_url' => 'required',
            'type' => 'required',
            'presented_by' => 'required',
        ], [
            'topic.required' => translate('Webinar Topic is required'),
            'image.required' => translate('Webinar thumbnail is required'),
            'start_date.required' => translate('Webinar start date is required'),
            'end_date.required' => translate('Webinar end date is required'),
            'topic_description.required' => translate('Description is required'),
            'recorded_video_url.required' => translate('Recorded Video Url is required'),
            'type.required' => translate('Type is required'),
            'presented_by.required' => translate('Presented by is required'),
        ]);

        $webinars = new Webinar();

        $webinars->topic = $request->topic;
        $webinars->topic_description = $request->topic_description;
        $webinars->recorded_video_url = $request->recorded_video_url;

        if ($request->has('image')) {
            $webinars->image = $request->image;
        } 

        $webinars->start_date = $request->start_date;
        $webinars->end_date = $request->end_date;
        $webinars->type = $request->type;
        $webinars->presented_by = $request->presented_by;
        $webinars->user_id = Auth::user()->id;

        if($request->is_live == "on") {
            $webinars->is_live = $request->is_live == "on" ? true : false;
            $webinars->live_url = $request->live_url;
        } else {
            $webinars->live_url = '';
        }

        $webinars->save();

        //todo::Webinar create notify
        $details = [
            'body' => translate($request->topic . ' new webinar created by ' . Auth::user()->name),
        ];

        /* sending instructor notification */
        $notify = $this->userNotify(Auth::user()->id,$details);

        notify()->success(translate($request->topic . ' created successfully'));
        return redirect()->route('webinar.index');

    }

    // webinar.destroy
    public function destroy($webinar_id)
    {

        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

        Webinar::findOrFail($webinar_id)->delete();
        notify()->success(translate('Webinar deleted successfully'));
        return back();
    }

    // webinar.edit
    public function edit($webinar_id)
    {
        $webinars = Webinar::findOrFail($webinar_id);
        return view('webinar.edit', compact('webinars'));
    }

    // webinar.update
    public function update(Request $request)
    {
        if (env('DEMO') === "YES") {
        Alert::warning('warning', 'This is demo purpose only');
        return back();
      }

      $request->validate([
            'topic' => 'required',
            'image' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'topic_description' => 'required',
            'recorded_video_url' => 'required',
            'type' => 'required',
            'presented_by' => 'required',
        ], [
            'topic.required' => translate('Webinar Topic is required'),
            'image.required' => translate('Webinar thumbnail is required'),
            'start_date.required' => translate('Webinar start date is required'),
            'end_date.required' => translate('Webinar end date is required'),
            'topic_description.required' => translate('Description is required'),
            'recorded_video_url.required' => translate('Recorded Video Url is required'),
            'type.required' => translate('Type is required'),
            'presented_by.required' => translate('Presented by is required'),
        ]);


        $webinars = Webinar::where('id', $request->id)->firstOrFail();

        $webinars->topic = $request->topic;
        $webinars->topic_description = $request->topic_description;
        $webinars->recorded_video_url = $request->recorded_video_url;

        if ($request->has('image')) {
            $webinars->image = $request->image;
        } 

        $webinars->start_date = $request->start_date;
        $webinars->end_date = $request->end_date;
        $webinars->type = $request->type;
        $webinars->presented_by = $request->presented_by;
        //    $webinars->user_id = Auth::user()->id;

        if($request->is_live == "on") {
            $webinars->is_live = $request->is_live == "on" ? true : false;
            $webinars->live_url = $request->live_url;
        } else {
            $webinars->live_url = '';
        }
       // return $webinars;
        $webinars->save();

        notify()->success(translate('Webinar Updated'));
        return redirect(route('webinar.index'));
    } 
    
    
    // webinar.createAssociation
    public function createAssociation($project_work_id, $slug)
    { 
        $assWebinars = Webinar::select('id','topic','start_date', 'end_date')
                        ->where('status', '=', '1')->get();
        return view('webinar.contents.create',compact('assWebinars','project_work_id','slug'));
    }

    // webinar.storeAssociation
    public function storeAssociation(Request $request)
    { 
        $projetc_work_id =  $request->projetc_work_id;
        $slug =  $request->slug;

        if(isset($request->webinar_ids))
        {
            if(count($request->webinar_ids)>0){
                for($i=0;$i<count($request->webinar_ids);$i++){

                    $dataExist = PwWebinar::select('id')
                                ->where('project_work_id', '=', $projetc_work_id)
                                ->where('webinar_id', '=', $request->webinar_ids[$i])
                                ->where('status', '=', '1')->count();

                    if($dataExist<1){            
                        $pwWebinar = new PwWebinar();
                        $pwWebinar->project_work_id = $projetc_work_id;
                        $pwWebinar->webinar_id = $request->webinar_ids[$i];
                        $pwWebinar->status = 1;
                        $pwWebinar->save();
                    }  
                }
                notify()->success(translate('Webinar associated successfully.'));
                return redirect()->route('pwcourse.show',[$projetc_work_id,$slug]);
            }
        } else {
            notify()->error(translate('Webinar not associated.'));
            return redirect()->route('pwcourse.show',[$projetc_work_id,$slug]);
        }    
    }
   
}
