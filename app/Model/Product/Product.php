<?php

namespace App\Model\Product;

use Illuminate\Database\Eloquent\Model;
use App\Helper\HelperClass\ModelHelper;

class Product extends Model
{

    protected $dispatchesEvents = [
        'updated' => \App\Events\Settings\Update::class,
        'created' => \App\Events\Settings\Update::class,
        'deleted' => \App\Events\Settings\Update::class,
    ];
    use ModelHelper;
    //
}
