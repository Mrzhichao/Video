<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //声明数据表的名称
   	public $table = 'carousel';

   	//声明数据表的主键
   	public $primaryKey = 'cid';

   	//过滤默认的字段
   	public $timestamps = false;

   	//批量接收数据 除了 _token
   	public $guarded = ['_token'];

   	public function video()
   	{
   		return $this->hasOne('App\Models\Admin\Video','vid','cid');
   	}

}
