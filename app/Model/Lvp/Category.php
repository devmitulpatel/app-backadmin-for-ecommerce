<?php

namespace App\Model\Lvp;

use App\Model\Lvp\Casts\publicUrl;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table="lvp_categories";

    protected $casts = [
        'image_url' => publicUrl::class,
    ];
}
