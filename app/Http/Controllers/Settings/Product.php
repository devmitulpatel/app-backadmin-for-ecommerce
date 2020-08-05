<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\generalSave;
use App\Http\Requests\Settings\websiteSave;
use Illuminate\Http\Request;

class Product extends Controller
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

                'save.website'=>route('settings.website.save'),
                'get.allUnits'=>route('settings.Product.Units.all'),
            ],

            'img'=>[

            ],
            'inputData'=>settings('website')->all()
        ];



        return view('settings.product')->with('data',$data)->with('Vuedata',$Vuedata);


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

    public function getAllUnits()
    {


        $model=\App\Model\Settings\Product\Units::where('status',1)->get();

        $model->map(function ($ar){
          //  $ar->uunitName=\App\Model\Settings\Product\Units::where('id',$ar->uunitId)->get()->first()->pluck('name');
            //$ar->uunitName="hello";
            $ar->uunitName=($ar->uunitId!=0)?\App\Model\Settings\Product\Units::where('id',$ar->uunitId)->get()->first()->toArray()['name']:"No Up Unit Defined";
            $ar->dunitName=($ar->dunitId!=0)?\App\Model\Settings\Product\Units::where('id',$ar->dunitId)->get()->first()->toArray()['name']:"No Up Unit Defined";
            return $ar;
        });


        return throwData(['All unir fetched successfully'],$model->toArray());


    }


}
