<?php

namespace App\Http\Controllers\lvp;

use App\Helper\HelperClass\Lvp\Doit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //

    public function __call($method, $parameters)
    {

        $parameters['r']=\request();

        return Doit::$method($parameters);

        parent::__call($method, $parameters); // TODO: Change the autogenerated stub


    }
}
