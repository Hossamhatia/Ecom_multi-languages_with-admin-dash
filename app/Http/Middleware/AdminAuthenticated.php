<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{

    public function handle($request, Closure $next,$guard = null)
    {
        if (Auth::guard('admin')->guest())
        {
            if ($request->ajax()|| $request->wantsJson())
            {
                return response('Unauthorized.',401);
            }else{
                return redirect(route('adminLogin'));
            }
        }

        return $next($request);
    }
}