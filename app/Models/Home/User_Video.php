<?php

namespace App\Models\Home;

use Illuminate\Database\Eloquent\Model;

class User_Video extends Model
{
    public $table = 'user_video';

    public $primaryKey = 'id';

    public $timestamps = false;

    public $guarded = [];
}
