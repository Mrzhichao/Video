<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SysConfig extends Model
{
   	//声明数据表的名称
   	public $table = 'system';

   	//声明数据表的主键
   	public $primaryKey = 'sid';

   	//过滤默认的字段
   	public $timestamps = false;

   	//批量接收数据 除了 _token
   	public $guarded = ['_token'];



}
