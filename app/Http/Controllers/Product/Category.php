<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\EditCat;
use App\Http\Requests\Product\SaveCat;
use App\Http\Requests\Settings\Product\DeleteFields;
use App\Model\Product\ProductCategory;
use App\Model\Settings\Product\Extra_Field;
use App\Model\Settings\Product\Units;
use Illuminate\Http\Request;

class Category extends Controller
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

            'save.cat'=>route('product.category.save'),
            'delete.cat'=>route('product.category.delete'),

            'delete.extraFields'=>route('settings.Product.Extra.delete'),
            'edit.units'=>route('settings.Product.Units.edit'),
            'edit.extraFields'=>route('settings.Product.Extra.edit'),
            'get.allUnits'=>route('settings.Product.Units.all'),
            'get.allExtra'=>route('settings.Product.Extra.all'),

            'get.allCat'=>route('settings.Product.Category.all'),




        ],

        'img'=>[

        ],
      //  'inputData'=>settings('product')->all(),

    ];


    return view('product.category')->with('data',$data)->with('Vuedata',$Vuedata);
}
    public function save(SaveCat $r){


        $response=[];
        $input=$r->all();
        $m=new ProductCategory();

        try {

            $m->updateOrInsert($input);

            return throwData(["New Category successfully added"]);

        }catch (\Exception $e){
            return throwError(["Category not added"]);

        }


    }

    public function delete(EditCat $r){

        $response=[];

        $input=$r->all();

        //  dd($input);

        $m=new ProductCategory();




        try {

            $m->where('id',$input['id'])->delete();

            return throwData(["Category removed successfully"]);
                //   'nextUrl'=>route('settings.website',['compact'=>true])


        }catch (\Exception $e){

            return throwError(['Category not removed']);


        }


    }
}
