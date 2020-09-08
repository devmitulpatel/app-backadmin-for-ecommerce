<?php

namespace App\Model\Lvp;

use App\Model\Lvp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    //
    protected $casts = [
        'video_url' => publicUrl::class,
        'thumb_url' => publicUrl::class,
        'zip_url' => publicUrl::class,
    ];
    protected $table="lvp_videos";
}
