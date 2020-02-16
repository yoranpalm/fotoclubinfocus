<?php

namespace App\Http\Middleware;

use Closure;

class UserAccessControll
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
        $url = explode("/", $request->path());

        if(isset($url[2]) && $url[0] === "foto"){
            $foto = \App\Foto::find($url[1]);

            if(\Auth::id() === $foto->userId || \Auth::user()->beheerderStatus === 1){
                return $next($request);
            } else {
                return redirect("/foto/$url[1]");
            }
        
        }
        if(isset($url[1]) && $url[0] === "foto" && $url[1] !== "create"){
            $foto = \App\Foto::find($url[1]);

            if($foto->epRating == 1){
                if(!\Auth::id() || $age = date_diff(date_create(\Auth::user()->birthdate), date_create('now'))->y <21) {
                    return redirect("/foto");
                }
            }
        }

        return $next($request);
    }
}
