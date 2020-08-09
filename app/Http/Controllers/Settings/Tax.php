<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\Tax\taxDelete;
use App\Http\Requests\Settings\Tax\taxSave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Settings\Tax as Taxes;

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

                'get.allTaxes'=>route('settings.tax.all'),
                'save.Tax'=>route('settings.tax.save'),
                'edit.Tax'=>route('settings.tax.edit'),
                'delete.Tax'=>route('settings.tax.delete'),



            ],

            'img'=>[

            ],
            'inputData'=>settings('product')->all(),

        ];


        return view('settings.tax')->with('data',$data)->with('Vuedata',$Vuedata);

    }

    public function getAllTaxes(){

        $m2=getModel(Taxes::class);

        $model=$m2->where('status',1)->orderBy('id','desc')->get();


        $data=$model->toArray();
        $rowData=[];

        // \Debugbar::info($model->pluck('id','name'));

        $model->map(function ($ar)use(&$m2,&$data,&$rowData){




            return $ar;
        });

        \Debugbar::info($data);




        return throwData(['All unir fetched successfully'],$model->toArray());

    }

    public function save(taxSave $r){

       return saveToModel(Taxes::class,$r,'Tax');

    }
    public function edit(){

    }
    public function delete(taxDelete $r){
        return deleteToModel(Taxes::class,$r,'Tax');
    }

}
