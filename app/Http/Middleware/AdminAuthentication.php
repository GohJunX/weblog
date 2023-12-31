<?php

namespace App\Http\Middleware;

use  Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class adminAuthenticate extends Middleware
{
  
      public function handle($request, Closure $next, ...$guards)
    {
      if(Auth::check() && Auth::user()->role == 'admin'){
        return $next($request);
      }
      return redirect('/');

    }

}