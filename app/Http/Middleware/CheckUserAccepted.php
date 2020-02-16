<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserAccepted
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
        if(\Auth::id() && \Auth::user()->beheerderAkkoord === 0){
            \Auth::logout();
            return redirect("/")->with("status", "Uw registratie wordt zo spoedig mogelijk gevalideerd");
        }

        if(\Auth::id() && \Auth::user()->blokkeerStatus === 1){
            \Auth::logout();
            return redirect("/")->with("status", "Uw account is geblokkeerd en daardoor kunt u niet meer inloggen. Neem contact op met de administratoren.");
        }
        

        return $next($request);
    }
}
