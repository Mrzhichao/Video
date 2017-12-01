<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class VideoAd extends Model
{
    //视频广告
    public $table = 'video_advertisement';

    //主键
    public $primaryKey = 'vaid';

    //选择过滤的字段
    public $guarded = ['_token'];

    //查询视频表的信息
    public function video()
   	{
   		return $this->hasOne('App\Models\Admin\Video','vid','vaid');
   	}


}
