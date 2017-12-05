<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Gregwar\Captcha\CaptchaBuilder;


require_once app_path().'\Org\code\Code.class.php';
use App\Org\code\Code;

class LoginController extends Controller
{
	//显示登录页面
    public function login()
    {
    	$title = '后台登录';
    	return view('Admin.Login.index',['title'=>$title]);
    }

    // 验证码生成
     public function yzm()
    {
        ob_clean();
        $code = new Code();
        $code->make();
    }

    //执行登录
    public function dologin(Request $request)
    {
    	//获取登录的数据
    	$input = $request -> except('_token');
    	//对数据进行表单验证
    	 $rule = [
            'aname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,20',
            "apwd"=>'required|between:3,20'
        ];


        $mess = [
            'aname.required'=>'用户名必须输入',
            'aname.regex'=>'用户名必须汉字字母下划线',
            'aname.between'=>'用户名必须在5到20位之间',
            'apwd.required'=>'密码必须输入',
            'apwd.between'=>'密码必须在5到20位之间'
        ];

         $validator =  Validator::make($input,$rule,$mess);
        //如果表单验证失败 passes()
          if ($validator->fails()) {
              return redirect('admin/login')
                  ->withErrors($validator)
                  ->withInput();
          }
           // 登录逻辑
		 // 验证验证码是否正确
       if( $input['code'] !=  Session::get('code')) {
           return redirect('admin/login')->with('errors','验证码错误');

          }
//        3.1 判断是否有此用户

        $user = Admin::where('aname',$input['aname'])->first();
          if(!$user){
              return redirect('admin/login')->with('errors','用户名不存在');
          }

//        3.2密码是否正确
         if( Crypt::decrypt($user->apwd) != trim($input['apwd']) ){
             return redirect('admin/login')->with('errors','密码不正确');
         }

//        4.登录成功，将用户信息保存到session中，用于判断用户是否登录以及获取登录用户信息
         Session::put('user',$user);
         
         // 5登录失败，返回登录页面
         return redirect('/');
       
    }

    public function loginout(Request $request)
    {
      $res = $request->session()->pull('user');
      if($res){
        return redirect('admin/login');
      }else{
        return back();
      }
    }
}
