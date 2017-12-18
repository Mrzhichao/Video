<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\VideoRecommend as vr;
use App\Models\Admin\Video;
class VideoRecommendController extends Controller
{

    /**
     * 电影精选
     * @author:Mrlu
     * @date:2017/12/07 
     * @param:
     * @return 把精选的电影返回到主页
     */
    //public function (){}

     /**
     * 推荐视频
     * @author:Mrlu
     * @date:2017/12/07 
     * @param:请求的数据
     * @return 把精选的电影返回到主页
     */
     public function tj(Request $request)
     {  

        //获取视频的编号
        $vid = $request->vid;

         //获取视频是否过期
        $time = Video::find($vid);

        if($time['projectionTime'] < time()){
            dd('影片已经过期');
        }

        //添加到数据库
        $vr = new vr;
        $vr -> videoid = $vid;
        $res = $vr->save();
        if($res){
            echo '已推荐';
        }else{
            echo '推荐失败';
        }

     }


     /**
     * 取消推荐
     * @author:Mrlu
     * @date:2017/12/07 
     * @param:请求的数据
     * @return 把精选的电影返回到主页
     */
     public function qx(Request $request)
     {  
        //获取视频的编号
        $vid = $request->vid;
        $rid = vr::where('videoid',$vid)->first();

        if($rid){
            //添加到数据库
           $res = vr::where('videoid',$vid)->delete();
            if($res){
                echo '已取消';
            }else{
                echo '取消失败';
            }
        }else{
            echo '请不要重复取消';
        }
       

     }

   
}
