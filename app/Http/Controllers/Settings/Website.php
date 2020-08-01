<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\websiteSave;
use Illuminate\Http\Request;

class Website extends Controller
{
    public function index(Request $r){

        $compact=false;
        if ($r->isMethod('post')) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
        }



        $data=[
            'full'=>!$compact

        ];


        $Vuedata=[
            'path'=>[

                'save.website'=>route('settings.website.save')
            ],

            'img'=>[

            ],
            'inputData'=>settings('website')->all()
            ];



        return view('settings.website')->with('data',$data)->with('Vuedata',$Vuedata);


    }


    public function save(websiteSave $r){


        $response=[];

        $m=new \App\Model\Settings\Website();

        try {

            $m->updateOrInsert(['id'=>1],$r->all());
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"General Setting Updated",
                'nextUrl'=>route('settings.website',['compact'=>true])

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
