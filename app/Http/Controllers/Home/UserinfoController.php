<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\User;
use App\Models\Home\Userinfo;
use Intervention\Image\ImageManagerStatic as Image;

class UserinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = $request ->session()->get('HomeUser');
        // // dd($res -> uid);
        //  $data= \DB::table('users')
        //     ->join('userinfo', 'users.uid', '=', 'userinfo.userid')
        //     ->select('users.*', 'userinfo.nickname', 'userinfo.qq')->get();
        //     // ->where('uid',$res->uid)->first();

        $data =User::where('uid',$res->uid) -> with('userinfo')->first();
        // if($data->avatar){
        //     return 111;
        // }else{
        //     return 222;
        // }
        // dd($data);
        return view('Home.Userinfo.userinfo',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 11;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($id);
        // $data  = $request -> except('_token','_method');
        // dd($data);
        $this->validate($request,[
            'nickname' => 'required|min:5|max:18',
            'realname'=>'required|min:2|max:6',
            'email' => 'unique:users,email,'.$id.',uid',
            'sex'=>'required',

            'phone' => 'required|size:11|unique:users,email,'.$id.',uid',
        ],[
            'nickname.required' => '昵称不能为空。',
            'nickname.min' => '昵称最小5个字符。',
            'nickname.max' => '昵称最大18个字符。',
            'realname.required' => '真实姓名不能为空。',
            'realname.min' => '真实姓名最小2个字符。',
            'realname.max' => '真是姓名最大6个字符。',
            'email.email' => '邮箱格式不正确。',
            'sex.required'=>'性格必须填写',
            'email.unique' => '邮箱已存在。',
            'phone.required' => '手机号不能为空。',
            'phone.size' => '手机长度不合适 。',
            'phone.unique' => '手机号已存在',
            'avatar.image' => '请选择一张图片才好。',
        ]);
        
        $data = $request->except('_token','_method');
        // if($data = )
        // dd($data);

        // 上传文件处理
        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                $ext = $request->file('avatar')->getClientOriginalExtension();
                $filename = str_random(32).'.'.$ext;
                $request->file('avatar')->move('./uploads/user', $filename);
                $data['avatar'] = $filename;
                //压缩图片
                $img = Image::make("./uploads/user/".$filename)->resize(120,100);
                $img->save("./uploads/user/s_".$filename);

                // 删除老图片。
                $oldPic = User::where('uid', $id)->first()->avatar;
                if($oldPic != 'default.jpg'){
                    unlink('./uploads/user/'.$oldPic);
                    unlink("./uploads/user/s_".$oldPic);
                  }

            }
        }
        // dd();
         // 修改用户表
            if(array_key_exists('avatar', $data)){
                $users = User::where('uid',$id)->update(['avatar'=>$data['avatar'],'sex' =>$data['sex'],'phone' =>$data['phone'],'email' =>$data['email']]);
                // dd($users);
            }else{
                $users = User::where('uid',$id)->update(['sex' =>$data['sex'],'phone' =>$data['phone'],'email' =>$data['email']]);
                // dd($users);
            }

            $res = Userinfo::where('userid',$id) -> first();
            // dd($res);
            // 判断
            if($res){
                //修改详情表
                $userinfo = Userinfo::where('userid',$id)->update(['nickname' =>$data['nickname'],'realname' =>$data['realname']]);
            }else{
                //添加
                $userinfo = Userinfo::create(['userid'=>$id,'nickname' =>$data['nickname'],'realname' =>$data['realname']]);
            }
            
        
          
       //判断是否修改成功
       if($users || $userinfo){
        return redirect('home/userinfo')->with('msg','修改成功');
       }else{
        return back()->with('msg','修改失败');
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
