<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;
class UserMiddleware
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
      if(Auth::check()){
        $kalan = time() - Session::get('timeout');
        if($kalan >= 60*15){
          Auth::logout();
          return redirect('/')->with(['tur'=>'alert-danger','mesaj'=>'Oturumunuzun süresi doldu']);
        }else{
          Session::forget('timeout');
          Session::put('timeout',time());
        }
      }
        return $next($request);
    }
}
