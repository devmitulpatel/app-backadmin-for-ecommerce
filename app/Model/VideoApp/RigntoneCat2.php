<?php

namespace App\Model\VideoApp;

use App\Model\VideoApp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class RingtoneCat2 extends Model
{
    protected $table="ringtone_cat_master2";
    protected $casts = [
       'icon' => publicUrl::class,
    ];

    protected $guarded = ['id','created_at'];
}
