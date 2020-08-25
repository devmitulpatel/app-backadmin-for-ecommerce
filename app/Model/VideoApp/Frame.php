<?php

namespace App\Model\VideoApp;

use App\Model\VideoApp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    protected $table="frame_master";

    protected $casts = [
        'imageUrl' => publicUrl::class,
        'thumbUrl' => publicUrl::class,
    ];

    protected $guarded = ['id','created_at'];
}
