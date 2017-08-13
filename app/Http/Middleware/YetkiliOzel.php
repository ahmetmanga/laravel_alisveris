<?php

namespace App\Http\Middleware;

use Closure;

class YetkiliOzel
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

            if(Auth::check() && Auth::user()->id == 1){
              return $next($request);
            }else{
              return redirect('')->with(['tur'=>'alert-danger','mesaj'=>'Bu alan için yetkin yok. <br />Bu alan yöneticilere özeldir. Bir hata olduğunu düşünüyorsanız iletişime geçin.']);
            }

    }
}
