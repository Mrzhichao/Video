<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
 use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    /**
     * 用户列表页显示
     * 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = '用户列表页';
        $keywords=$request->input('keyword');
        $data = User::where('uname','like',"%".$keywords."%")->simplePaginate(1);
        return view('Admin.User.index',['title'=>$title,'data'=>$data,'where'=>['keyword'=>$keywords]]);

    }

    /**
     * Show the form for creating a new resource.
     *用户添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = '用户添加';
        return view('Admin.User.create',['title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'uname' => 'required|min:5|max:18',
            'upwd' => 'required',
            're_upwd' => 'same:upwd',
            'email' => 'email',
            'phone' => 'required|size:11',
            'avatar' => 'image'
        ],[
            'uname.required' => '用户名不能为空。',
            'uname.min' => '用户名最小6个字符。',
            'uname.max' => '用户名最大18个字符。',
            'updated_at.required' => '密码不能为空。',
            're_upwd.same' => '确认密码不一致。',
            'email.email' => '邮箱格式不正确。',
            'phone.required' => '手机号不能为空。',
            'phone.size' => '手机长度不合适 。',
            'avatar.image' => '请选择一张图片才好。',
        ]);

        $data = $request->except('_token', 're_upwd');
        $data['upwd'] = encrypt($data['upwd']);

        //上传文件处理
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

            }
        }else
        {
            $data['avatar'] = 'default.jpg';
        }
       $res =  User::create($data);
       if($res){
        return redirect('admin/user');
       }else{
        return back();
       }
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
        //
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
