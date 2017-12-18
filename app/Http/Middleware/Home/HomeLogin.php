<?php

namespace App\Http\Middleware\Home;

use Closure;
use Session;

class HomeLogin
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

        // dd(Session::get('HomeUser '));
        $res = $request->session() -> get('HomeUser');
        // dd($res);
         //如果用户登录了就放行，如果没有登录就拦住返回到登录页面
        if($res){
            return $next($request);
        }else{
            return redirect('home/login')->with('errors','请先登录，注意素质');
        }

    }
}
