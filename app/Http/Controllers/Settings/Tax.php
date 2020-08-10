<?php

namespace App\Http\Controllers\Settings;

use App\Http\Requests\Settings\Tax\taxCodeSave;
use App\Http\Requests\Settings\Tax\taxDelete;
use App\Http\Requests\Settings\Tax\taxEdit;
use App\Http\Requests\Settings\Tax\taxSave;
use App\Model\Settings\TaxCodes;
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

                'get.allTaxesCodes'=>route('settings.tax.code.all'),
                'save.TaxCodes'=>route('settings.tax.code.save'),
                'edit.TaxCodes'=>route('settings.tax.code.edit'),
                'delete.TaxCodes'=>route('settings.tax.code.delete'),




            ],

            'img'=>[

            ],
           // 'inputData'=>settings('product')->all(),

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
    public function getAllCodes(){

        $m2=getModel(TaxCodes::class);

        $model=$m2->where('status',1)->orderBy('id','desc')->get();

        $m1=getModel(Taxes::class);
        $m1=$m1->get();

        $data=$model->toArray();
        $rowData=[];

        // \Debugbar::info($model->pluck('id','name'));

        $model->map(function ($ar)use($m1){
            $decodeTax=json_decode($ar->tax,true);
            foreach ($decodeTax as $taxId=>$taxper){
                $data=$m1->where('id',$taxId)->first();
                if($data!=null){
                    $name=$data->toArray()['name'];
                    $ar->$name=$taxper;
                }
            }
            return $ar;
        });

      //  \Debugbar::info($model->toArray());




        return throwData(['All unir fetched successfully'],$model->toArray());

    }

    public function save(taxSave $r){
        return saveToModel(Taxes::class,$r,'Tax');
    }
    public function edit(taxEdit $r){
        return editToModel(Taxes::class,$r,'tax');
    }
    public function delete(taxDelete $r){
        return deleteToModel(Taxes::class,$r,'Tax');
    }

    public function saveCode(taxCodeSave $r){
        $input=$this->makeDataforTaxCode($r);

        return saveToModel(TaxCodes::class,$r,'GST Code',$input);
    }
    public function editCode(taxEdit $r){
        $input=$this->makeDataforTaxCode($r);

        return editToModel(TaxCodes::class,$r,'GST Code',[],$input );
    }
    public function deleteCode(taxDelete $r){
        return deleteToModel(TaxCodes::class,$r,'GST Code');
    }

    private function makeDataforTaxCode($r){
        $input=$r->all();
        $m1=getModel(Taxes::class);
        $m1=$m1->get()->pluck('id','name');
        if(!array_key_exists('tax',$input)){
            foreach ($m1 as $name=>$id){
            $input['tax'][$id]=$input[$name];
            unset($input[$name]);
            }
        }else{
            $input['tax']=json_decode($input['tax'],true);
            $newTax=[];
            foreach ($m1 as $name=>$id){
                $newTax[$id]=$input[$name];
                unset($input[$name]);
            }
            $input['tax']=$newTax;
       }
        \Debugbar::info($m1);
        $allowed=['id','code','tax','status'];
        $finalInput=[];

        foreach ($input as $c=>$v){
            if(in_array($c,$allowed))$finalInput[$c]=$v;
        }

        $input=$finalInput;


        if(array_key_exists('tax',$input)&& gettype($input['tax']))$input['tax']=collect($input['tax'])->toJson();

    //    dd($input);
        return $input;

    }

}
