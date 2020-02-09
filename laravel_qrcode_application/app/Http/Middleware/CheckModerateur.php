<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Flash;
class CheckModerateur
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
        if(Auth::user()->role_id >2 ){
            Flash::error("Désolé, vous n'êtes pas autorisé à accéder à cette page"); 
            return redirect('/qrcodes');
        }
        return $next($request);
    }
}
