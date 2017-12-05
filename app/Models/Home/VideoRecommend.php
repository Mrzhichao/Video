<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

class VideoRecommend extends Model
{
    //视频推荐
    //
    //声明数据表的名称
   	public $table = 'videorecommend';

   	//声明数据表的主键
   	public $primaryKey = 'rid';

   	//过滤默认的字段
   	public $timestamps = false;

   	//批量接收数据 除了 _token
   	public $guarded = ['_token'];

   	public function video()
   	{
   		return $this->hasOne('App\Models\Admin\Video','vid','rid');
   	}

}
