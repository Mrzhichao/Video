<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Home\User;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    /**
     * 登录页显示
     *
     * @return \Illuminate\Http\Response
     */
    public function Login(Request $request)
    {
        $title = '前台登录';

        // $res = $request ->session('remember')->get('user');
        // dd($res);
        return view('Home.Login.index',['title'=>$title]);
    }

    /**
     * 执行登录
     */
    
    public function doLogin(Request $Request)
    {
        $input = $Request->except('_token');
        // dd($input['remember']);
        // dd(array_key_exists('remember', $input));
        // // dd(strpos($input['user'],"@"));
        //dd(strpos($input['user'],".com") == false);
        $str = $input['user'];
        //手机号正则表达式
        $phone = "/^1[34578]\d{9}$/";
        //邮箱正则表达式
        $email = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        //手机号执行匹配
        $tel = preg_match_all($phone,$str,$arr);
        //邮箱执行匹配
        $mail =  preg_match_all($email,$str,$arr);
        // dd($arr);
        // 手机号
        if($tel)
        {
             // // 对数据进行表单验证
             $rule = [
                'user'=>'required|size:11',
                "upwd"=>'required|between:5,16'
            ];
            $mess = [
                'user.required'=>'手机号必须输入',
                'user.regex'=>'手机号必须是数字',
                'user.between'=>'手机号必须11',
                'upwd.required'=>'密码必须输入',
                'upwd.between'=>'密码必须在5到16位之间'
            ];
             $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
              if ($validator->fails()) {
                  return redirect('home/login')
                      ->withErrors($validator)
                      ->withInput();
              }
            
            $user = User::where('phone',$input['user'])->first();
            // dd($user);
            //判断此用户的状态
            if(!empty($user)){
                if($user->status == 0){
                    return redirect('home/login')->with('errors','用户未激活,请查看邮箱前去激活');
                }
            }
            //判断是否有此用户
             if(!$user){
                  return redirect('home/login')->with('errors','手机号不存在');
              }

            // 3.2密码是否正确
             if( Crypt::decrypt($user->upwd) != trim($input['upwd']) ){
                 return redirect('home/login')->with('errors','密码不正确');
             }
              //判断是不是记住密码
              if(array_key_exists('remember', $input)){
                  // dd(111);
                  Session::put('remember',$input);
              }
             // 4.登录成功，将用户信息保存到session中，用于判断用户是否登录以及获取登录用户信息
             Session::put('HomeUser',$user);

            // 判断是否是一天中第一次登录
            $lastLogintime = $user['logintime'];
            // dd($lastLogintime);
            // 一天中的零时零分零秒
            $today = strtotime(date('Y-m-d'));
            // dd($user -> roleid);
            if($lastLogintime < $today && $user -> roleid == 4){
               $user->integral += 5;
               $user ->logintime = time();
               $user->save();
            }
            // 5登录失败，返回登录页面
            return redirect('/');
        }elseif($mail || (strpos($input['user'],".com") != false) || (strpos($input['user'],"@") != false) ){
            // // 对数据进行表单验证
             $rule = [
                'user'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',
                "upwd"=>'required|between:5,16'
            ];
            $mess = [
                'user.required'=>'邮箱必须输入',
                'user.regex'=>'必须是邮箱格式',
                'upwd.required'=>'密码必须输入',
                'upwd.between'=>'密码必须在5到16位之间'
            ];
             $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
              if ($validator->fails()) {
                  return redirect('home/login')
                      ->withErrors($validator)
                      ->withInput();
              }
              // return 1111;
            $user = User::where('email',$input['user'])->first();
            if(!empty($user)){
                //判断此用户的状态
                if($user->status == 0){
                    return redirect('home/login')->with('errors','用户未激活,请查看邮箱前去激活');
                }
            }
            
            // //判断是否有此用户
             if(!$user){
                  return redirect('home/login')->with('errors','用户邮箱不存在');
              }

            // 3.2密码是否正确
             if( Crypt::decrypt($user->upwd) != trim($input['upwd']) ){
                 return redirect('home/login')->with('errors','密码不正确');
             }
             // 4.登录成功，将用户信息保存到session中，用于判断用户是否登录以及获取登录用户信息
             Session::put('HomeUser',$user);

             // 判断是否是一天中第一次登录
            $lastLogintime = $user['logintime'];
            // dd($lastLogintime);
            // 一天中的零时零分零秒
            $today = strtotime(date('Y-m-d'));
            // dd($user -> roleid);
            if($lastLogintime < $today && $user -> roleid == 4){
                return 111;
               $user->integral += 5;
               $user ->logintime = time();
               $user->save();
            }
            // 5登录失败，返回登录页面
            return redirect('/');
        }else{
           //对数据进行表单验证
             $rule = [
                'user'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,20',
                "upwd"=>'required|between:5,16'
            ];
            $mess = [
                'user.required'=>'用户名必须输入',
                'user.regex'=>'用户名必须汉字字母下划线',
                'user.between'=>'用户名必须在5到20位之间',
                'upwd.required'=>'密码必须输入',
                'upwd.between'=>'密码必须在5到16位之间'
            ];
            $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
              if ($validator->fails()) {
                  return redirect('home/login')
                      ->withErrors($validator)
                      ->withInput();
              }
              // return 1111;
            $user = User::where('uname',$input['user'])->first();
            if(!empty($user)){
                //判断此用户的状态
                if($user->status == 0){
                    return redirect('home/login')->with('errors','用户未激活,请查看邮箱前去激活');
                }
            }
            
            //判断是否有此用户
             if(!$user){
                  return redirect('home/login')->with('errors','用户名不存在');
              }

            // 3.2密码是否正确
             if( Crypt::decrypt($user->upwd) != trim($input['upwd']) ){
                 return redirect('home/login')->with('errors','密码不正确');
             }
             // 4.登录成功，将用户信息保存到session中，用于判断用户是否登录以及获取登录用户信息
             Session::put('HomeUser',$user);

             // 判断是否是一天中第一次登录
            $lastLogintime = $user['logintime'];
            // dd($lastLogintime);
            // 1513126655
            // 一天中的零时零分零秒
            $today = strtotime(date('Y-m-d'));
            // "2017-12-13"
            // dd($today);
            // 1513123200
            // dd(time());
            // 1513128426
            // dd($user -> roleid);
            if($lastLogintime < $today && $user -> roleid == 4){
               $user->integral += 5;
               $user ->logintime = time();
               $user->save();
            }

            // 5登录失败，返回登录页面
            return redirect('/');
        }
    }

}
