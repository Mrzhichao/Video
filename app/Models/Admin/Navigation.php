<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    //导航列表
    public $table = 'navigation';
    public $primaryKey = 'nid';
    public $guarded = [];
    public $timestamps = false;

    // public function type()
    // {
    // 	return $this->hasMany('App\Models\Admin\VideoType','vtid','nid');
    // }

}
