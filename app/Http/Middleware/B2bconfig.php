<?php

namespace App\Http\Middleware;
use Closure;

use App\B2bconfiguration;
use Session;

class B2bconfig
{ 
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
   public function handle($request, Closure $next)
   {
    try {

        // $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // // dd($actual_link);
        // $parsedUrl = parse_url($actual_link);

        // $host = explode('.', $parsedUrl['host']);

        // $subdomain = $host[0];

        // $slugId = $subdomain;

        // $getB2Blogo = B2bconfiguration::select('theme_configration','universities_id','logo')->where('slug' , $slugId)->first(); 
        
        // if($actual_link == "http://localhost/entrepreneurindia.tv/"){
            Session::put('school_id', 2);
        // }
        
        // else{
        //     Session::put('school_id', $getB2Blogo->universities_id);
        // }
        return $next($request);
    }catch (\Exception $exception){
        return redirect()->route('install');
    }
        
    }
}
