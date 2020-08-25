<?php

namespace App\Model\VideoApp;

use App\Model\VideoApp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    //
    protected $table="sticker_master";
    protected $casts = [
        'thumbUrl' => publicUrl::class,
    ];
    protected $guarded = ['id','created_at'];
}
