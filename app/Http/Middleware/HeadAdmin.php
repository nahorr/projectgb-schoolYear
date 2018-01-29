<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

use Auth;

class HeadAdmin
{
    
    public function handle($request, Closure $next)
    {
        if(!Auth::guard('web_admin')->user()->is_head_admin){

        return redirect()->to('/admin_home')->withError('Permission Denied');

    }
        return $next($request);
    }
}
