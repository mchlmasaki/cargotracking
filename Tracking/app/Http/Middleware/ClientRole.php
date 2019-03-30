<?php

namespace App\Http\Middleware;

use Closure;
use Auth; 

class ClientRole
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
        $role = Auth::user()->role;
        if ($role!="Client") {
            return redirect('403')->send();
           // dd("Unauthorised Access!");
        }
        return $next($request);
    }
}
