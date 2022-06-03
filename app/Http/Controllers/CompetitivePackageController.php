<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PackageSetting;
use App\PackageAddonService;
use App\Model\Category;
use App\Model\Course;
use DB;

class CompetitivePackageController extends Controller
{
    //
    private  $theme = 'frontend';
    function __construct()
    {
        $this->theme = themeManager();
        $this->middleware(['installed']);
    }
    public function competitive()
    {
        //package_settings package_addon_services categories courses

        $getData = PackageSetting::select('package_settings.*','Cat.name as catName')->join('categories as Cat','Cat.id','=','package_settings.category_id')
                    ->where('package_type','=','competitive-courses')
                    ->orderBy('id', 'DESC')->paginate(100);

        return view($this->theme.'.competitive.competitive_grid',compact('getData'))
                        ->with('i',(request()->input('page', 1) - 1) * 100);

    }

    public function preview_competitive($id)
    {
        
        $idGet      = explode('_',$id);
        $cGetId     = $idGet[1];
        $getAddon   = PackageAddonService::leftjoin('services','services.id','=','package_addon_services.addon_service_id')
                                         ->where('package_addon_services.package_id','=',$idGet[0])
                                         ->select('package_addon_services.*','services.service_name')
                                         ->get();  
        $getData    = PackageSetting::join('categories as Cat','Cat.id','=','package_settings.category_id')
                                    ->select('package_settings.*','Cat.name as catName')
                                    ->where('package_settings.id','=',$idGet[0])
                                    ->orderBy('id', 'DESC')->first();

        

        return view($this->theme.'.competitive.preview_competitive',compact('getData','cGetId','getAddon'));
    }
}
