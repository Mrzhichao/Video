<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin\Admin;
use App\Models\Admin\Roles;
class HasRole
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

        //获取当前的控制器方法
        $aa = \Route::currentRouteAction();
        //获当前的路由
        $role = strstr($aa,'@',-1);
        
        //获取后台角色ID
        $id = \Session::get('user')->aid;
        $data = Admin::find($id)->role;
        //获取角色权限
        $arr = [];
        foreach($data as $k=>$v){
            foreach($v->auth as $kk=>$vv){
                $arr[] = $vv->adesc;
            }
        }
        //去除重复值哦
        $arr = array_unique($arr);

        //判断当前访问的模块在不在所属权限中
       if(in_array($role,$arr)){
            return $next($request);
       }else{
           return redirect('admin/error/auth');
       }

       
    }
}
