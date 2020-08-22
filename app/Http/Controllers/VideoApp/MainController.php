<?php

namespace App\Http\Controllers\VideoApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Help\VideoApp\Doit;

class MainController extends Controller
{
    //

    public function allForms(Request $r){
        $compact=false;
        if ($r->isMethod('post')) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
        }

        $data=[
            'full'=>!$compact

        ];
        $Vuedata=[

            'path'=>[
                'retriveListData'=>route('videoapp.getData')

            ]
        ];


        return view('VideoApp.allForms')->with('data',$data)->with('Vuedata',$Vuedata);


    }

    public function getData(Request $r){
        return Doit::getData($r);
    }
}
