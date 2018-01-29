<?php

namespace App\Http\Middleware;

use Closure;

//use Illuminate\Support\Facades\Auth;

use App\Admin;

use Auth;



class SuperAdmin
{
  public function handle($request, Closure $next)
  {

    if(!Auth::guard('web_admin')->user()->is_super_admin){

        return redirect()->to('/admin_home')->withError('Permission Denied');

    }

    return $next($request);

}
    
    
}