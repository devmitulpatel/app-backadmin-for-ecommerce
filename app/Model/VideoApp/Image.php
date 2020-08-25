<?php

namespace App\Model\VideoApp;

use App\Model\VideoApp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table="image_master";

    protected $casts = [
        'imageUrl' => publicUrl::class,
        'thumbUrl' => publicUrl::class,
    ];

    protected $guarded = ['id','created_at'];
}
