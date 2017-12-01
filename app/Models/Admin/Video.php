<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
   public $table = 'videos';
   public $primaryKey='vid';
   
   public $timestamps = false;


   public $guarded = [];


    public function users()
    {
      return $this->belongsTo('App\Models\Admin\User', 'userid','uid');
    }

    public function videoType(){
      return $this->hasOne('App\Models\Admin\VideoType','vtid','vid');
    }


}
