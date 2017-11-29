<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
	//声明数据表的名称
   	public $table = 'admin';

   	//声明数据表的主键
   	public $primaryKey = 'aid';

   	//过滤默认的字段
   	public $timestamps = false;
   	
   	//批量接收数据 除了 _token
   	public $guarded = ['_token'];
}