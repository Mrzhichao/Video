<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Navigation as nav;
use App\Models\Admin\Link;
use App\Models\Admin\Video;
use App\Models\Admin\Advertisement as ad;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //获取导航
        $nav = nav::take(6)->get();
        //友情链接
        $link = Link::get();

        //评分最高的视频
        $Vfirst = Video::orderBy('vscores','desc')->take(8)->get();
        //热门推荐
        $rmtj = Video::inRandomOrder()->take(5)->get();

        //随机广告
        $oneAd = ad ::inRandomOrder()->first();

         //今日推荐
        $tj = \DB::table('videos')
            ->join('videorecommend', 'videos.vid', '=', 'videorecommend.videoid')
            ->get();

            //如果下映了  就删除
            foreach($tj as $k=>&$v){
                if($v->projectionTime < time()){
                    unset($tj[$k]);
                }
            }



        View::share('nav', $nav);
        View::share('link', $link);
        View::share('Vfirst',$Vfirst);
        View::share('oneAd',$oneAd);
        View::share('tj',$tj);
        View::share('rmtj',$rmtj);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
