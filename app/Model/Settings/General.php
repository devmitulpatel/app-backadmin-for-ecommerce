<?php

namespace App\Model\Settings;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Helper\HelperClass\ModelHelper;


class General extends Model
{
    use ModelHelper;

    protected $dispatchesEvents = [
        'updated' => \App\Events\Settings\Update::class,
    ];

    protected $fillable=[
        'CompanyName'
    ];
    protected $table="settings_generals";

}
