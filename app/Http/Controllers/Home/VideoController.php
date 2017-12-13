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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title='视频类型详情';
        $pid=1;

        //获取一级分类下的年代
        $addTimes=VideoType::where('pid',$pid)->get(['addTime']);
        foreach($addTimes as $key=>$addTime){
            $years[]=date('Y',$addTime['addTime']);
        }
        $years=array_unique($years);

        //进入详情页
        if(!empty(Session('detail_search'))){
            $data=Session('detail_search');
            return view('Home.Video.show',['title'=>$title,'data'=>$data,'years'=>$years]);   
        }else{

            //获取一级分类下的地区
            $videos=VideoType::with('video')->where('pid',$pid)->get()->toArray();
            foreach($videos as $key=>$video){
                foreach($video['video'] as $v){
                    $areas[]=$v['area'];
                }
            }
            $areas=array_unique($areas);

            //传来的是 pid     根据pid查出所有 vtids //  再查视频表中     typeid 在 vtids 中的视频的地区字段
            $data=VideoType::with('video')->where('pid',$pid)->get();
            // dd($data[0]['video'][0]['logo']);
            return view('Home.Video.index',compact('title','years','areas','data'));  
        }
       
    }

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

}
