<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Video;
use App\Models\Admin\VideoType;

class VideoTypeController extends Controller
{

    /**
     * 视频类型首页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title='视频类别首页';
        
        $types =  (new VideoType) -> tree();

        return view('Admin.VideoType.index',['types'=>$types,'title'=>$title]);  
    }


    /**
     * 添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title='视频分类添加';

        $aname=Session('user')->aname;
        $types=VideoType::get();

        return view('Admin.VideoType.add',['title'=>$title,'aname'=>$aname,'types'=>$types,]);
    }


    /**
     * 添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证
        $this->validate(
                        $request, 
                        [

                            'pid' => 'required',

                            'vtname' => 'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:1,5',  //只允许数字和字母
                            'uname'=>'required|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u|between:1,5',

                            'reason'=>'required',
                        ],

                        [
                            
                            'pid.required'=>'所属类型为必选项',

                            'vtname.required'=>'视频类型名称为必选项',
                            'vtname.regex'=>'视频类型名称只允许数字和字母',
                            'vtname.between'=>'视频类型名称只能为1--5位的名称',

                            'uname.required'=>'视频类型上传者为必选项',
                            'uname.regex'=>'视频类型上传者只允许数字和字母',
                            'uname.between'=>'视频类型上传者只能为1--5位的名称',

                            'reason.required'=>'视频类型添加理由不能为空',
                        ]
        );

        $input = $request->except('_token');

        $now=strtotime("now");
        $input['addTime']=$now;
        $input['editTime']=$now;

        $input['status']=0;
        $input['order_sort']=1;
        
        $res = VideoType::create($input);
        if($res){
            return redirect('admin/videotype');
        }else{
            return back();
        }

    }


    /**
     * 视频类别详情
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title='视频类别详情页';

        //二级分类显示所有视频分类
        $types =  (new VideoType) -> tree(); 

        if( !empty($request) ){
            $keywords=$request->input('search');  
            $videos = Video::with('users','types')->where('vname','like',"%".$keywords."%")->where('typeid',$id)->orderby('type_order','asc')->paginate(1);   
            return view('Admin.Video.index',['videos'=>$videos,'title'=>$title,'types'=>$types,'where'=>['search'=>$keywords] ]);  
        }else{
            //渴求式加载多个关联关系
            $videos = Video::with('users','types')->where('typeid',$id)->orderby('type_order','asc')->get();           
            return view('Admin.Video.index',['videos'=>$videos,'title'=>$title,'types'=>$types]);   
        }

    }


    /**
     * 这是修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = '视频类别修改';

        $videotype = VideoType::find($id);  
        $types=VideoType::get();

        return view('Admin.VideoType.edit',['videotype'=>$videotype,'types'=>$types,'title'=>$title]);
    }


    /**
     * 修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vtid)
    {
        $input = $request->except('_token','_method');
    
        //过滤掉空数据
        foreach($input as $k=>&$v){
            if(!$v){unset($input[$k]); }
        }

        if( !empty($request->editTime) ){
            $input['editTime']=strtotime($request->editTime);
        }

        $video_type=VideoType::find($vtid);
        $res = $video_type->update($input);
        
        if($res){
            return redirect('admin/videotype');
        }else{
            return redirect('admin/videotype/'.$videotype->vtid.'/edit');
        }

    }


    /**
     * 删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flag='flase';
        $data = [];

        $types=VideoType::where('pid',$id)->get();
        foreach($types as $key => $type){
            $flag = 'true';
        }
        
        if( $flag=='true' ){
            $data['error'] = 2;
            $data['msg'] ="该视频分类下有子分类,不能删除";
        }else{
            $res = VideoType::find($id)->delete();
            if($res){
                $data['error'] = 0;
                $data['msg'] ="删除成功";
            }else{
                $data['error'] = 1;
                $data['msg'] ="删除失败";
            }
        }

        return $data;
    }


    /**
     *  ajax排序操作
     *
     * @return \Illuminate\Http\Response
     */
    public function changeOrder(Request $request)
    {
        $vtid = $request->input('vtid');
        
        $cate = VideoType::find($vtid);
        //要修改的值
        $order_sort = $request->input('order_sort');

        $res = $cate->update(['order_sort'=>$order_sort]);

        if($res){
            $data =[
                'status'=> 0,
                'msg'=>'修改成功'
            ];
        }else{
            $data =[
               'status'=> 1,
               'msg'=>'修改失败'
            ];
        }

        return $data;
    }


}
