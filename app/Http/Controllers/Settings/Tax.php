<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class Tax extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $compact=false;
        if ($r->isMethod('post')) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
        }



        $data=[
            'full'=>!$compact

        ];


        $Vuedata=[
            'path'=>[

                'save.units'=>route('settings.Product.Units.save'),
                'save.extraFields'=>route('settings.Product.Extra.save'),
                'delete.units'=>route('settings.Product.Units.delete'),
                'delete.extraFields'=>route('settings.Product.Extra.delete'),
                'edit.units'=>route('settings.Product.Units.edit'),
                'edit.extraFields'=>route('settings.Product.Extra.edit'),
                'get.allUnits'=>route('settings.Product.Units.all'),
                'get.allExtra'=>route('settings.Product.Extra.all'),
                'get.allCat'=>route('settings.Product.Category.all'),
                'get.allSCat'=>route('settings.Product.SubCategory.all'),



            ],

            'img'=>[

            ],
            'inputData'=>settings('product')->all(),

        ];


        return view('settings.tax')->with('data',$data)->with('Vuedata',$Vuedata);

    }


}
