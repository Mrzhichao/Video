<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class advertisement extends Model
{
	//声明数据表的名称
   	public $table = 'advertisement';

   	//声明数据表的主键
   	public $primaryKey = 'id';

   	//过滤默认的字段
   	public $timestamps = false;

   	//批量接收数据 除了 _token
   	public $guarded = ['_token'];

   	//多对一
   	public function post()
   	{
   		return $this->belongsTo('App\Models\Admin\admin','id','aid');

   	}
}
