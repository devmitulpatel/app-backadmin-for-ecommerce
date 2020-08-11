<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;


use App\Http\Requests\Settings\Product\DeleteFields;
use App\Http\Requests\Settings\Product\DeleteUnit;
use App\Http\Requests\Settings\Product\EditFields;
use App\Http\Requests\Settings\Product\EditUnit;

use App\Http\Requests\Settings\Product\GetAllSubWithoutId;
use App\Http\Requests\Settings\Product\SaveFields;
use App\Http\Requests\Settings\Product\SaveUnit;
use App\Http\Requests\Settings\websiteSave;
use App\Model\Settings\Product\Extra_Field;
use App\Model\Settings\Product\Units;
use App\Model\Product\ProductCategory;
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

    public function saveUnit(SaveUnit $r){

       // dd($r->all());

        $response=[];
        $input=$r->all();
        $m=new Units();
        if(array_key_exists('uunitName',$input))unset($input['uunitName']);
        if(array_key_exists('dunitName',$input))unset($input['dunitName']);
        if(array_key_exists('updated_at',$input) && $input['updated_at'])$input['updated_at']=now();

        try {

            $m->updateOrInsert($input);
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"New Unit successfully added.",
             //   'nextUrl'=>route('settings.website',['compact'=>true])

            ];

        }catch (\Exception $e){
            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Unit not added",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);

    }

    public function editUnit(EditUnit $r)
    {

        $response=[];
        $input=$r->all();
        $m=new \App\Model\Settings\Product\Units();

        if(array_key_exists('uunitName',$input))unset($input['uunitName']);
        if(array_key_exists('dunitName',$input))unset($input['dunitName']);
        if(array_key_exists('updated_at',$input) && $input['updated_at'])$input['updated_at']=now();
        if(array_key_exists('created_at',$input) && $input['created_at'])unset($input['created_at']);

        if(!array_key_exists('uunit',$input))$input['uunit']=0;

       // dd($input);
        try {
            $id=$input['id'];
            unset($input['id']);
          //  $input=array_filter($input);
            //dd($input);
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"Unit Updated successfully",
                'debug'=>$m->where('id',$id)->update($input)
             //   'nextUrl'=>route('settings.website',['compact'=>true])

            ];

        }catch (\Exception $e){

            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Unit not Updated",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);
    }

    public function deleteUnit(DeleteUnit $r){

        $response=[];

        $input=$r->all();

      //  dd($input);

        $m=new Units();

        $m2=new \App\Model\Settings\Product();
        $m2D=$m2->where('id',1)->pluck('defaultUnit');


        try {

            $m->where('id',$input['id'])->delete();
            if($m2D->first()==$input['id'])$m2->where('id',1)->update(['defaultUnit'=>$m->get()->pluck('id')->first()]);

            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"Unit removed successfully",
                //   'nextUrl'=>route('settings.website',['compact'=>true])

            ];

        }catch (\Exception $e){
            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Unit not removed",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);

    }


    public function getAllUnits()
    {




        $m2=getModel(Units::class);

        $model=$m2->where('status',1)->orderBy('id','desc')->get();


        $data=$model->pluck('name','id')->toArray();
        $rowData=[];

       // \Debugbar::info($model->pluck('id','name'));

        $model->map(function ($ar)use(&$m2,&$data,&$rowData){
          //  $ar->uunitName=\App\Model\Settings\Product\Units::where('id',$ar->uunitId)->get()->first()->pluck('name');
            //$ar->uunitName="hello";
            if(array_key_exists($ar->id,$data))$data[$ar->id]=$ar->name;

                if($ar->dunitId!=0){

                    if(array_key_exists($ar->dunitId,$data)){
                        $dUniname=$data[$ar->dunitId];
                    }else{
                        $dUniname=$m2->where('id',$ar->dunitId)->get()->first();
                        if($dUniname!=null){
                            $dUniname=$dUniname->toArray();
                            $data[$ar->dunitId]=$dUniname['name'];

                        }
                    }

                $ar->dunitName=$data[$ar->dunitId];
                    if($dUniname==null)$ar->dunit=0.0;

                }else{
                    $ar->dunitName="No Unit Defined";
                }
                if($ar->uunitId!=0){

                    if(array_key_exists($ar->uunitId,$data)){
                        $uUniname=$data[$ar->uunitId];
                    }else{
                        $uUniname=$m2->where('id',$ar->uunitId)->get()->first();
                        if($uUniname!=null){
                            $uUniname=$uUniname->toArray();
                            $data[$ar->uunitId]=$uUniname['name'];

                        }
                    }

                    $ar->uunitName= $data[$ar->uunitId];
                    if($uUniname==null)$ar->unit=0.0;

                }else{
                    $ar->uunitName="No Unit Defined";
                }

               // $data[]=;
//                $dUniname=$m2->where('id',$ar->dunitId)->get()->first();
//                $uUniname=$m2->where('id',$ar->uunitId)->get()->first();
//
//                $ar->uunitName=($ar->uunitId!=0 && $uUniname!=null)?$uUniname->toArray()['name']:"No Up Unit Defined";
//                $ar->dunitName=($ar->dunitId!=0 && $dUniname!=null)?$dUniname->toArray()['name']:"No Up Unit Defined";




            return $ar;
        });

        \Debugbar::info($data);




        return throwData(['All unir fetched successfully'],$model->toArray());


    }


    public function getAllExtra(Request $r){


        $input=$r->all();

        $masterModel1=getModel(Extra_Field::class);
        $masterModel2=getModel(ProductCategory::class);
        $modelAllData=[];
        $modelMatserCatData=[];

        $m2=$masterModel2;

        $produvctCategory=$m2->all();


        if(count($input)>0 && array_key_exists('cat',$input) && array_key_exists('scat',$input)){
            if($input['scat']=='undefined' || $input['scat']=='')$input['scat'];
            $model=$masterModel1::orderBy('id','desc')->where('cat',$input['cat'])->where('scat',$input['scat'])->get();

            $modelAll=$masterModel1::orderBy('id','desc')->where('cat',0)->where('scat',0)->get();

            if($input['cat']!=0){

                $modelMatserCat=$masterModel1::orderBy('id','desc')->where('cat',$input['cat'])->where('scat',0)->get();
                $modelMatserCatData=$modelMatserCat->toArray();


            }
            $modelAllData=$modelAll->toArray();

        }else{
            $model=$masterModel1::orderBy('id','desc')->get();
        }




        $model->map(function ($ar)use($produvctCategory){

            $catName=$produvctCategory->where('id',$ar->cat)->first();
            $scatName=$produvctCategory->where('ParentCategoryId',$ar->cat)->where('id',$ar->scat)->first();

            $ar->catName=($ar->cat!=0 && $catName!=null)?$catName->toArray()['name']:"No Category Defined";
            $ar->scatName=($ar->scat!=0 && $scatName!=null)?$scatName->toArray()['name']:"No Sub Category Defined";



            return $ar;
        });


        return throwData(['All Extra Fields fetched successfully'],array_merge($modelAllData,$modelMatserCatData,$model->toArray()));
    }

    public function saveExtra (SaveFields $r){

        // dd($r->all());

        $response=[];
        $input=$r->all();
        $m=new Extra_Field();

        $default=['scat','cat'];
        foreach ($default as $c){
            if(!array_key_exists($c,$input))$input[$c]='0';
        }


        try {

           $debug= $m->insert($input);
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"New Field successfully added",
                'debug'=>$debug
                //   'nextUrl'=>route('settings.website',['compact'=>true])

            ];

        }catch (\Exception $e){
            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Unit not added",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);

    }
    public function editExtra (EditFields $r)
    {

        $response=[];
        $input=$r->all();
        $m=new \App\Model\Settings\Product\Extra_Field();

        if(array_key_exists('catName',$input))unset($input['catName']);
        if(array_key_exists('scatName',$input))unset($input['scatName']);
        if(array_key_exists('updated_at',$input) && $input['updated_at'])$input['updated_at']=now();

        try {
            $id=$input['id'];
            unset($input['id']);

          //  $input=array_filter($input);
            //dd($input);
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"Field Updated successfully",
                'debug'=>$m->where('id',$id)->update($input)
                //   'nextUrl'=>route('settings.website',['compact'=>true])

            ];

        }catch (\Exception $e){

            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Unit not Updated",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);
    }

    public function deleteExtra(DeleteFields $r){

        $response=[];

        $input=$r->all();

        //  dd($input);

        $m=new Extra_Field();




        try {

            $m->where('id',$input['id'])->delete();

            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"Field removed successfully",
                //   'nextUrl'=>route('settings.website',['compact'=>true])

            ];

        }catch (\Exception $e){
            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Unit not removed",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);

    }

    public function getAllCategory(Request $r){
        $model=\App\Model\Product\ProductCategory::where('status',1)->where('ParentCategoryId',null)->orderBy('id','desc')->get();





        $model->map(function ($ar){
            //  $ar->uunitName=\App\Model\Settings\Product\Units::where('id',$ar->uunitId)->get()->first()->pluck('name');
            //$ar->uunitName="hello";
            return $ar;
        });


        return throwData(['All Category fetched successfully'],$model->toArray());
    }
    public function getAllSubCategory(GetAllSubWithoutId $r){
        $input=$r->all();

        if(array_key_exists('id',$input)){
            $model=\App\Model\Product\ProductCategory::where('status',1)->where('ParentCategoryId',$input['id'])->orderBy('id','desc')->get();
        }else{
            $model=\App\Model\Product\ProductCategory::where('status',1)->whereNotNull('ParentCategoryId')->orderBy('id','desc')->get();
        }



        $m2=new \App\Model\Product\ProductCategory();


        $model->map(function ($ar)use($m2){
         if($ar->ParentCategoryId!=null){
          $data=$m2->where('id',$ar->ParentCategoryId)->get();

             if($data->count()>0)$ar->catName=$data->first()->toArray()['name'];
         }

            return $ar;
        });


        return throwData(['All Sub Category fetched successfully'],$model->toArray());
    }





}
