<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBaseOnTier
{
    public function handle(Request $request, Closure $next, ...$tiers)
    {
        
      
            if(Auth::check() && in_array(Auth::user()->tier, $tiers)){
                return $next($request);
            }
        

        return redirect('/');
    }
}
