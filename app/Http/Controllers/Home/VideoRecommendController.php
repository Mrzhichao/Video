<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Home\VideoRecommend as vr;
use App\Models\Admin\Video;
class VideoRecommendController extends Controller
{
   
	/**
     * 视频按 评分 排行
     * @author:Mrlu
     * @date:2017/12/05 
     * @param:请求的信息
     * @return 把排行的数据发送到首页
     */
    public function first()
    {
    	//获取视频数据
        $data = video::orderBy('vscores','desc')->take(3)->get();
        dd($data);

    }



}
