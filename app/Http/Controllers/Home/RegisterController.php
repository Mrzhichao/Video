<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Mail;
use App\SMS\SendTemplateSMS;
use App\SMS\M3Result;
use Illuminate\Support\Facades\Crypt;
use App\Models\Home\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //手机号注册页面显示
    public function PhoneRegister()
    {
    	$title = '注册页面';
    	return view('Home.Register.index',['title'=>$title]);
    }
    //执行登录
    public function doPhoneRegister(Request $request)
    {	
         // 1 . 接受客户端传过来的注册数据
         $input = $request->except('_token','re_upwd');
         // dd($input);
//        2. 表单验证
          $this->validate($request,[
            'uname' => 'required|unique:users,uname|regex:/^[\x{4e00}-\x{9fa5}A-Za-z_]+$/u|min:5|max:18',
            'upwd' => 'required',
            're_upwd' => 'same:upwd',
            'email' => 'email|unique:users',
            'phone' => 'required|unique:users|size:11',
        ],[
            'uname.required' => '用户名不能为空。',
            'uname.min' => '用户名最小5个字符。',
            'uname.max' => '用户名最大18个字符。',
            'uname.regex'=>'用户名必须汉字字母下划线',
            'uname.unique'=>'用户名已存在',
            'upwd.required' => '密码不能为空。',
            're_upwd.same' => '确认密码不一致。',
            'email.email' => '邮箱格式不正确。',
            'email.unique'=>'邮箱已存在',
            'phone.required' => '手机号不能为空。',
            'phone.size' => '手机长度不合适 。',
            'phone.unique'=>'手机号已存在',
        ]);
        // dd($input);
        // 3. 向用户表中添加注册记录
         //加密
         //
         // dd($input['code']);
         
        $input['upwd'] = Crypt::encrypt($input['upwd']) ;
        //设置token值
        $input['token'] = md5($input['upwd'].rand(1000,9999));
        //判断提交的验证码是否一样
        // dd($input['code']);
        // dd(session('phone'));
        if($input['code'] != session::get('phone')){
            return redirect('home/phoneregister')->with('msg','验证码错误');
        }
        unset($input['code']);
        //设置默认头像
         $input['avatar'] = 'default.jpg';
        //添加成功后，返回刚才添加的那条用户记录
       $res =  User::create($input);
       // dd($res);
       if($res){

        // 4. 给注册邮箱发送注册邮件
        //参数一： 对方收到的邮件模板
        //参数二：邮件模板中需要的变量
        //参数三：关于邮件注册的变量，如发件人，主题、收件人等信息
           Mail::send('Home.Email.active', ['user' => $res], function ($m) use ($res) {
               //$m->from('hello@app.com', 'Your Application');

               $m->to($res->email, $res->uname)->subject('ActiveVideo邮箱激活!');
           });


           return redirect('home/login')->with('msg','注册成功,请去邮箱激活');

       }else{
           return back()->with('msg','注册失败');
       }

    }
    //手机发送验证码ajax
    public function Sendcode(Request $request)
    {	
        // return 11111;
      //session()->put('phone', '1234');
    	 $input = $request->except('_token');
        //return $input;

        $tempSms = new SendTemplateSMS();

//    * @param to 手机号码集合,用英文逗号分开
//    * @param datas 内容数据 格式为数组 第一个元素是一个随机数，表示验证码；第二个参数是验证码的有效时间 如5分钟
//    * @param $tempId 模板Id

//        参数1 手机号
        $phone = $input['phone'];

//        参数2
        $r = mt_rand(1000,9999);
        $arr = [$r,1];

        $M3Result = new M3Result();
        $M3Result = $tempSms->sendTemplateSMS($phone,$arr,1);
        //发送验证码成功后，将验证码存入session中
       session()->put('phone', $r);

        return $M3Result->toJson();
    }

    //邮箱激活
    public function Email(Request $request)
    {
        //找到要激活的用户,将这条记录的artive字段的值改为1
        //知道要激活的用户
        $user = User::find($request['uid']);
        // 验证激活链接的有效性
        if($request['key'] != $user->token)
        {
            return '无效的激活链接';
        }
        $res = $user -> update(['status'=>1]);
        if($res){   
            return redirect('home/login')->with('msg','激活成功');
        }else{
            return '激活失败';
        }
    }

    //忘记密码
    //找回密码页面
    public function Forget()
    {
        $title = '找回密码';
        return view('Home.Reset.forget',['title'=>$title]);
    }
    //发送找回密码邮件
    public function doForget(Request $request)
    {
        //获取表达提交数据
        $input = $request->except('_token');
        //表单验证
          $this->validate($request,[
            'email' => 'required|email|',
        ],[
            'email.email' => '邮箱格式不正确。',
            'email.required'=>'邮箱不能为空',
        ]);
        //根据邮箱获取的收件人
        $res = User::where('email',$input['email'])->first();
        if($res){
            Mail::send('Home.Email.forget', ['user' => $res], function ($m) use ($res) {
               //$m->from('hello@app.com', 'Your Application');

               $m->to($res->email, $res->uname)->subject('ActiveVideo密码找回!');
           });
            return redirect('home/login')->with('msg','修改密码邮箱已发送,请前去修改密码');
        }else{
            return back()->with('msg','修改失败');
        }

        
    }
    //重置密码页面
    public function Reset()
    {
        $title = '修改密码';
        return view('Home.Register.register',['title'=>$title]);
    }

    //修改密码
    public function doReset(Request $request)
    {
        $input = $request->except('_token');

        //接收过来的$input['user']
        $str = $input['user'];
        // dd($str);
        //手机号正则表达式
        $phone = "/^1[34578]\d{9}$/";
        //邮箱正则表达式
        $email = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        //手机号执行匹配
        $tel = preg_match_all($phone,$str,$arr);
        //邮箱执行匹配
        $mail =  preg_match_all($email,$str,$arr);
        if($tel){
            // // 对数据进行表单验证
             $rule = [
                'user'=>'required|size:11',
                "upwd"=>'required|between:5,16',
                're_upwd' => 'same:upwd',
            ];
            $mess = [
                'user.required'=>'手机号必须输入',
                'user.regex'=>'手机号必须是数字',
                'user.between'=>'手机号必须11',
                'upwd.required'=>'密码必须输入',
                're_upwd.same' => '确认密码不一致',
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
            //判断是否有此用户
             if(!$user){
                  return back()->with('errors','手机号不存在');
              }
            // dd($user -> uid);
            // dd($user);
            $input['phone'] = $input['user'];
            $input['upwd'] = Crypt::encrypt($input['upwd']) ;
            unset($input['re_upwd']);
            unset($input['user']);
            
            // dd($input);
            $res = User::find($user->uid) -> update($input);
            // dd($res);
           //判断是否修改成功
           if($res){
            return redirect('home/login')->with('msg','修改成功');
           }else{
            return back()->with('msg','修改失败');
           }
        }elseif( $mail || (strpos($input['user'],".com") != false) || (strpos($input['user'],"@") != false) ){
            // // 对数据进行表单验证
             $rule = [
                'user'=>'required|regex:/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i',
                "upwd"=>'required|between:5,16',
                're_upwd' => 'same:upwd',
            ];
            $mess = [
                'user.required'=>'邮箱必须输入',
                'user.regex'=>'必须是邮箱格式',
                'upwd.required'=>'密码必须输入',
                'upwd.between'=>'密码必须在5到16位之间',
                're_upwd.same' => '确认密码不一致',
            ];
             $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
              if ($validator->fails()) {
                  return redirect('home/login')
                      ->withErrors($validator)
                      ->withInput();
              }
            
            $user = User::where('email',$input['user'])->first();
            //判断是否有此用户
             if(!$user){
                  return back()->with('errors','邮箱不存在');
              }
            // dd($user -> uid);
            // dd($user);
            $input['email'] = $input['user'];
            $input['upwd'] = Crypt::encrypt($input['upwd']) ;
            unset($input['re_upwd']);
            unset($input['user']);
            
            // dd($input);
            $res = User::find($user->uid) -> update($input);
            // dd($res);
           //判断是否修改成功
           if($res){
            return redirect('home/login')->with('msg','修改成功');
           }else{
            return back()->with('msg','修改失败');
           }
        }else{
             // // 对数据进行表单验证
             $rule = [
                'user'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:5,20',
                "upwd"=>'required|between:5,16',
                're_upwd' => 'same:upwd',
            ];
            $mess = [
                'user.required'=>'用户名必须输入',
                'user.regex'=>'用户名必须汉字字母下划线',
                'user.between'=>'用户名必须在5到20位之间',
                'upwd.required'=>'密码必须输入',
                'upwd.between'=>'密码必须在5到16位之间',
                're_upwd.same' => '确认密码不一致',
            ];
             $validator =  Validator::make($input,$rule,$mess);
            //如果表单验证失败 passes()
              if ($validator->fails()) {
                  return redirect('home/login')
                      ->withErrors($validator)
                      ->withInput();
              }
            
            $user = User::where('uname',$input['user'])->first();
            //判断是否有此用户
             if(!$user){
                  return back()->with('errors','用户名不存在');
              }
            // dd($user -> uid);
            // dd($user);
            $input['uname'] = $input['user'];
            $input['upwd'] = Crypt::encrypt($input['upwd']) ;
            unset($input['re_upwd']);
            unset($input['user']);
            
            // dd($input);
            $res = User::find($user->uid) -> update($input);
            // dd($res);
           //判断是否修改成功
           if($res){
            return redirect('home/login')->with('msg','修改成功');
           }else{
            return back()->with('msg','修改失败');
           }
        }
    }
}
