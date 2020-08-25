<?php

namespace App\Model\VideoApp;

use App\Model\VideoApp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class Ringtone extends Model
{
    protected $table="ringtone_master";
    protected $casts = [
        'mp3Url' => publicUrl::class,
        'thumbUrl' => publicUrl::class,
    ];

    protected $guarded = ['id','created_at'];
}
