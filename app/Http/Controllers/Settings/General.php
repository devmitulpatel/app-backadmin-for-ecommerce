<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class General extends Controller
{
    //

    public function index(Request $r){

        $compact=($r->has('compact') && $r->get('compact'))?true:false;

        $data=[
          'full'=>!$compact
        ];



        return view('settings.general')->with('data',$data);

        dd('ok');

    }
}
