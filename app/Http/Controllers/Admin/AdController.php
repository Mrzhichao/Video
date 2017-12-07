<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Advertisement;
use Intervention\Image\ImageManagerStatic as Image; 
use Illuminate\Support\Facades\Session;



class AdController extends Controller
{
    /**
     * 显示广告所有的信息
     * @author:Mrlu
     * @date:2017/11/28
     * @param:请求信息
     * @返回一个广告主页的模板和标题,广告信息
     */
    public function index(Request $request)
    {

        // //获取关键字搜索
        $namekey = empty($_GET['aname']) ? '' : $_GET['aname']; 
        
        // //查询数据库
        $data = Advertisement::where('aname','like','%'.$namekey.'%')->paginate(8); 

       //将查询到的用户名放进数组
      
        return view('Admin.Ad.index',['title'=>'广告预览','data'=>$data])->with('namekey',['aname'=>$namekey]);


    }
    /**
     * 广告添加模块
     * @author:Mrlu
     * @date:2017/11/28 
     * @return 返回一个添加模板 并把用户名和标题传递过去
     */
    public function create(Request $request)
    {
        // $uid = $_GET['id']; 查询哪个用户添加的广告

        $aname = $request -> Session()->get('user')->aname; 

        // $uid = DB::table('data_users')->where('uid',$uid)->first(); //获取前台用户名并发送
        // $user = Advertisement::get();
        // dd($user);
        $user = Advertisement::get();
         return view('Admin.Ad.create',['title'=>'广告添加','aname'=>$aname]);
         
    }



    /**
     * 将用户添加的信息处理后写入数据库
     * @author:Mrlu
     * @date:2017/11/28
     * @param:表单中数据请求的集合
     * @return 成功返回主页  失败返回back()
     */
    public function store(Request $request)
    {

        //验证表单
        
        $this->validate($request, [
            'adesc' => 'required|max:50',
            'acontent' => 'required|max:100|url',
            'aimg' => 'image|required',
            'startTime' => 'required|date',
            'endTime' => 'required|date',
            'aprice' => 'required',
        ],[
            'adesc.required' => '请填写描述信息',
            'adesc.max' => '长度不能超过50',
            'acontent.required' => '请填写URL链接',
            'acontent.max' => '长度不能超过100',
            'acontent.url' => '请填写正确的URL地址',
            'aimg.image' => '请上传图片类广告哦',
            'aimg.required' => '请上传广告图片哦',
            'startTime.required' => '请选择开始时间哦',
            'startTime.data' => '请选择有效时间哦',
            'endTime.required' => '请选择结束时间哦',
            'endTime.data' => '请选择有效时间哦',
            'aprice.required' => '请点击金额进行计算o.o ',

        ]);

        //获取文件的信息
          
          //判断是否有上传
        if($request->hasFile("aimg")){
            //获取上传信息
            $file = $request->file("aimg");
            //确认上传的文件是否成功
            if($file->isValid()){
                $ext = $file->getClientOriginalExtension(); //获取上传文件名的后缀名
                //执行移动上传文件
                $filename = 'Ad'.time().rand(1000,9999).".".$ext;
                $file->move("./uploads/Ad/",$filename);
                
                //压缩图片
                 $img = Image::make("./uploads/Ad/".$filename)->resize(60,40);
                 $img->save("./uploads/Ad/s_".$filename);

               
            }
        }
        



        //获取数据
        $data = $request -> except('_token','aimg');

        //处理时间
        $data['startTime'] = strtotime($data['startTime']);
        $data['endTime'] = strtotime($data['endTime']);
        $data['aimg'] = $filename; 

        $res = Advertisement::create($data);
        if($res){
            //如果添加成功 跳到广告主页
            return redirect('admin/ad')->with('msg','成功添加');
        }else{
            //失败 返回上一个页面
            return redirect('admin/ad/create')->with('msg','添加失败');
        }


         
    }

    /**
     * 将用户添加的信息处理后写入数据库
     * @author:Mrlu
     * @date:2017/11/29
     * @param:广告的编号
     * @return 返回一个修改页面
     */
    public function show($id)
    {
        //
        //
        
    }

    /**
     * 将用户添加的信息处理后写入数据库
     * @author:Mrlu
     * @date:2017/11/29
     * @param:广告的编号,用于查询某条广告
     * @return 返回一个编辑页面 广告信息 标题传过去
     */
    public function edit($id)
    {
        //查询某条数据
        $ainfo = Advertisement::find($id);
        

        //返回一个修改模板
        return view('Admin.Ad.edit',['title'=>'广告修改','data'=>$ainfo]);
       
    }

    /**
     * 获取要修改的内容并在数据库中修改
     * @author:Mrlu
     * @date:2017/11/29
     * @param:id广告的编号,用于修改某条广告的信息 request 获取请求的信息 
     * @return 返回一个编辑页面 广告信息 标题传过去
     */
    public function update(Request $request, $id)
    {

         //验证表单
        
        $this->validate($request, [
            'adesc' => 'max:50',
            'acontent' => 'max:100|url',
            'startTime' => 'date',
            'endTime' => 'date',
            'aprice' => 'required',
        ],[
            'adesc.max' => '长度不能超过50',
            'acontent.max' => '长度不能超过100',
            'acontent.url' => '请填写正确的URL地址',
            'startTime.data' => '请选择有效时间哦',
            'endTime.data' => '请选择有效时间哦',
            'aprice.required' => '请重新进行金额计算哦o.o ',

        ]);


        //获取数据
       $data = $request -> except('_token','_method');
       
       //过滤掉空数据
       foreach($data as $k=>&$v){
        if(!$data[$k]){
            unset($data[$k]); 
        }
       }
    
       //处理数据
       if($data['startTime']){
            $data['startTime'] = strtotime($data['startTime']);
       }
       if($data['endTime']){
            $data['endTime'] = strtotime($data['endTime']);
       }

      //修改数据库
        $res = Advertisement::find($id)->update($data);
        //判断
        if($res){
            return redirect('admin/ad')->with('msg','更新成功');
        }else{
            return redirect('admin/ad/'.$id.'/edit')->with('msg','更新失败');
        }
  

    }



    /**
     * 删除某条的广告
     * @author:Mrlu
     * @date:2017/11/29
     * @param: $id  要删除的ID
     * @return 
     */
    public function destroy($id)
    {
       $res = Advertisement::find($id)->delete();
       if($res){
            echo '删除成功';
       }else{
        echo '删除失败';
       }
    }


     /**
     * ajax修改图片
     * @author:Mrlu
     * @date:2017/12/4
     * @param:表单和ID
     * @return 返回图片的路径
     */
    public function ajax(Request $request)
    {
        //获取id
        $id = $request->id; 
        $file = $request -> file('upload');
        if($file->isValid()){
        $entension = $file->getClientOriginalExtension();//上传文件的后缀名
        $newName = 'Ad'.time().mt_rand(1000,9999).'.'.$entension;
        //上传到本地服务器的方法
        $path = $file->move(public_path().'/uploads/Ad/',$newName);

         //压缩图片
          $img = Image::make("./uploads/Ad/".$newName)->resize(60,40);
          $img->save("./uploads/Ad/s_".$newName);  

        //移动成功后 修改数据库并删除老图片
        $oldImg = Advertisement::find($id);
        if($oldImg->aimg){
            //如果文件存在就删除
            if(file_exists('/uploads/Ad/'.$oldImg->aimg)){
                unlink('/uploads/Ad/'.$oldImg->aimg);
            }
        }
       //修改数据库
        // $oldImg -> vpath = $newName;
        Advertisement::find($id) -> update(['aimg'=>$newName]);
        //将上传文件的路径返回给浏览器客户端
        $filepath = 'uploads/Ad/'.$newName;
        return $filepath;
        }
       
       
    }



}
