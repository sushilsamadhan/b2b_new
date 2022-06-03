<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\UrlPermission;

class UrlPermissionController extends Controller
{
    // if no url access permission
    public function redirect(){
        return view('module.url_access.redirect');
    }

    public function index(Request $request){
        $users              = User::join('instructors','instructors.user_id','=','users.id')
                                ->where('user_type','Instructor')
                                ->where('instructors.is_external','=','3')
                                ->get();
                                
        $url_permissions    = UrlPermission::select('instructors.name','url_permissions.user_id',                            'url_permissions.site_url','url_permissions.id')
                            ->join('instructors','instructors.user_id','=','url_permissions.user_id')
                            ->paginate(25);

        return view('module.url_access.index',compact('users','url_permissions'));
    }

    public function add(Request $request){
        //$data = [];
        $request->validate([
            'site_url' => 'required',
            'user_id' => 'required|unique:url_permissions'
        ],[
            'user_id.required' => 'Please Select Instructor',
            'user_id.unique' => 'Instructor already exist, You can edit only.',
            'site_url.required' => 'Please Enter Url Name',
        ]);
        
        $data['user_id']    = $request->input('user_id');
        $data['site_url']        = $request->input('site_url');

        UrlPermission::create($data);
        return redirect()->back()->with('success','Permission Added Successfully!');
    }

    public function update(Request $request){

        $id = $request->input('id');
        $userid             = $request->input('userid');
        $data['site_url']   = $request->input('site_url');

        UrlPermission::where('id',$id)->where('user_id',$userid)->update($data);
        
        return redirect()->back()->with('success','Site Url Updated Successfully!');
    }
}
