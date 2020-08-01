<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\generalSave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class General extends Controller
{
    //

    public function index(Request $r){

        $compact=false;
        if ($r->isMethod('post')) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
        }

        $data=[
          'full'=>!$compact
        ];

        return view('settings.general')->with('data',$data);


    }

    public function save(generalSave $r){


        $response=[];

        $m=new \App\Model\Settings\General();

        try {


            $m->updateOrInsert(['id'=>1],$r->all());
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"General Setting Updated",
                'nextUrl'=>route('settings.general',['compact'=>true])

            ];

        }catch (\Exception $e){
            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"General Setting Not Updated",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);

    }
}
