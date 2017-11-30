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
        //用户表  角色表查询
  
        // $users = User::get();
        // foreach ($users as $k => $v){
        //    $user['rname'] = User::find($v -> uid) -> rname;
        // }
        // dd($user);
        // ,'arr'=>$arr
        // 搜索 分页
        $keywords=$request->input('keyword');

            $data = User::where('uname','like',"%".$keywords."%")->Paginate(5);

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
     *添加用户操作
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
        //加密
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
            //不上传给默认值
            $data['avatar'] = 'default.jpg';
        }
        //插入数据库
       $res =  User::create($data);
       //判断是否登录成功
       if($res){
        return redirect('admin/user')->with('msg','添加成功');;
       }else{
        return back()->with('msg','添加失败');;
       }
    }

    /**
     * Display the specified resource.
     *用户详情
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 显示修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $title = '修改页面';
       $data = User::find($id);
       return view('Admin.User.edit',['title'=>$title,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'uname' => 'required|min:5|max:18',
            'email' => 'email',
            'phone' => 'required|size:11',
            'avatar' => 'image'
        ],[
            'uname.required' => '用户名不能为空。',
            'uname.min' => '用户名最小6个字符。',
            'uname.max' => '用户名最大18个字符。',
            'email.email' => '邮箱格式不正确。',
            'phone.required' => '手机号不能为空。',
            'phone.size' => '手机长度不合适 。',
            'avatar.image' => '请选择一张图片才好。',
        ]);
        
        $data = $request->except('_token');
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
        //修改插入数据库
       $res = User::find($id) -> update($data);
       //判断是否修改成功
       if($res){
        return redirect('admin/user')->with('msg','修改成功');
       }else{
        return back()->with('msg','修改失败');
       }
    }

    /**
     * Remove the specified resource from storage.
     *删除数据
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //通过id删除数据
        $res = User::find($id)->delete();

        //判断是否删除成功
        if($res){
            echo '删除成功';
            // return redirect('admin/user')->with('msg','删除成功');
        }else{
          echo '删除失败';
            // return back()->with('msg','修改失败');
        }
    }
}
