<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class VideoReview extends Model
{
     public $table = 'videoreview';

    public $primaryKey = 'rid';

    public $timestamps = false;

    public $guarded = [];
}
