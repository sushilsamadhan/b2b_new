<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class Installed
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
            if (!DB::connection()->getPdo() || env('MIX_PUSHER_APP_CLUSTER_SECURE') == '7469a286259799e5b37e5db9296f00b3' ){
                return redirect()->route('install');
            }
            return $next($request);
        }catch (\Exception $exception){
            return redirect()->route('install');
        }
    }
}
