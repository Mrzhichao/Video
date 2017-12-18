<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Admin\Video;
use App\Models\Admin\VideoType;
use Illuminate\Support\Facades\Session;

class VideoController extends Controller
{

    /**
     *  前台视频页面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='视频类型详情';
        $pid=empty($_GET['pid'])?'':$_GET['pid'];
        
        //获取年代
        $addTimes=VideoType::where('pid',$pid)->get(['addTime']);

        foreach($addTimes as $key=>$addTime){
            $years[]=date('Y',$addTime['addTime']);
        }
        
        $years=array_unique($years);

        //进入详情页
        if(!empty(Session('detail_search'))){
            $data=Session('detail_search');
            // dd($data);
            return view('Home.Video.show',['title'=>$title,'data'=>$data,'years'=>$years,'pid'=>$pid]);   
        }else{

            //获取地区
            $videos=VideoType::with('video')->where('pid',$pid)->get()->toArray();
            foreach($videos as $key=>$video){
                foreach($video['video'] as $v){
                    $areas[]=$v['area'];
                }
            }
           $areas=array_unique($areas);

            //传来的是 pid     根据pid查出所有 vtids //  再查视频表中     typeid 在 vtids 中的视频的地区字段
            $data=VideoType::with('video')->where('pid',$pid)->get();

            return view('Home.Video.index',compact('title','years','areas','data'));  
        }
       
    }


    /**
     *  清空session中的detail_search
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_session()
    {
        Session::put('detail_search','');
        $pid=empty($_GET['pid'])?'':$_GET['pid'];
        return redirect('home/video?pid='.$pid);
    }


    /**
     *  多条件搜索方法
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function type_ajax(Request $request)
    {     
        $data=Video::with('types')->orderBy('type_order','asc')
            ->where(function($query) use($request){
                    $types= $request->input('type');  
                    $value= $request->input('value');  
            //类型:
            if(!empty($types[0]) ){
                $vtid=VideoType::where('vtname','=',"$value[0]")->select(['vtid'])->first();
                $query->where('typeid',$vtid['vtid']);
            }
            //年代:
            if(!empty($types[1])){
                $year_int=strtotime($value[1]);
                $prev_int=strtotime('-1year',$year_int);
                $next_int=strtotime('+1year',$year_int);
                $query->where("publicTime",'<=',"$next_int");
                $query->where("publicTime",'>=',"$prev_int");
            }
            //地区
            if(!empty($types[2])){
                $query->where("area","=","$value[2]");   
            }

            })->get();



        if($data){
            // return $data;
            Session::put('detail_search',$data);
            $res =[
                'status'=> 0,
                'msg'=>'成功'
            ];
        }else{
            $res =[
                'status'=> 1,
                'msg'=>'失败'
            ];
        }
        return $res;
    }


    /**
     *  Vip视频页面
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vip()
    {
        $title='视频类型详情';
        
        //获取一级分类下的年代
        $addTimes=Video::with('types')->where('isVip','=','1')->get();
        foreach($addTimes as $key=>$addTime){
            $years[]=date('Y',$addTime['types']['addTime']);
        }

        $years=array_unique($years);

        //进入详情页
        if(!empty(Session('detail_search'))){
            $data=Session('detail_search');
            return view('Home.Video.show',['title'=>$title,'data'=>$data,'years'=>$years]);   
        }else{
            //获取一级分类下的地区
            $videos=Video::with('types')->where('isVip','=','1')->get()->toArray();
            foreach($videos as $key=>$video){
                $areas[]=$video['area'];
            }
            $areas=array_unique($areas);

            //传来的是 pid     根据pid查出所有 vtids //  再查视频表中     typeid 在 vtids 中的视频的地区字段
            $data=Video::with('types')->where('isVip','=','1')->get();
            return view('Home.Video.vip',compact('title','years','areas','data'));  
        }

    }


}