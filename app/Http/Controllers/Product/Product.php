<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SaveProduct;
use App\Model\Product\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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

                'save.cat'=>route('product.category.save'),
                'delete.cat'=>route('product.category.delete'),
                'edit.cat'=>route('product.category.edit'),


                'delete.extraFields'=>route('settings.Product.Extra.delete'),

                'edit.extraFields'=>route('settings.Product.Extra.edit'),
                'get.allUnits'=>route('settings.Product.Units.all'),

                'get.allExtra'=>route('settings.Product.Extra.all'),
                'get.allCat'=>route('settings.Product.Category.all'),
                'get.allSCat'=>route('settings.Product.SubCategory.all'),
                'upload.img'=>route('product.img.upload'),

                'save.product'=>route('product.save')




            ],

            'img'=>[

            ],
            //  'inputData'=>settings('product')->all(),

        ];


        return view('product.addproduct')->with('data',$data)->with('Vuedata',$Vuedata);
    }

    public function save(SaveProduct $r){


        $input=$r->all();

        dd($input);


        return saveToModel(\App\Model\Product\Product::class,$r,'Product');




    }


    public function uploadImage(Request $r){

        if($r->hasFile('upload') && $r->file('upload')->isValid()){
            $code=Str::slug(Str::random(5));
            $ext=$r->upload->extension();
            $filename=implode('.',[$code,$ext]);
            $driver='product';
            $path=$r->upload->storeAs('descriptionImages', $filename,$driver);
            $link=$this->addImageEntryToDB($filename,$driver,$path);
           return response()->json(['fileName'=>$filename,'uploaded'=> $r->file('upload')->isValid(),'url'=>$link]);
        }

        return response()->json(['fileName'=>'','uploaded'=> false,'url'=>'/']);

    }

    public function getImage($code){
        return$this->getImageFromDB($code);
    }

    private function addImageEntryToDB($filename,$driver,$path){

        $m=getModel(ProductImages::class);
        $fileExplo=explode('.',$filename);

        $code=reset($fileExplo);
        $m->insert(
            [
                'code'=>$code,
                'path'=>collect([['path'=>$path,'driver'=>$driver,'filename'=>$filename]])->toJson()
            ]
        );

        return route('product.img.get',['code'=>$code]);

    }

    private function getImageFromDB($code){
        $m=getModel(ProductImages::class);
        $data=$m->where('code','=',$code)->get();

        if($data->count()>0){

            $imgData=$data->map(function ($ar){
                $ar->path=json_decode($ar->path,true);
                if(count($ar->path)==1)$ar->path=$ar->path[0];
                return $ar;
            })->first()->toArray();

            $img=Storage::disk($imgData['path']['driver'])->get($imgData['path']['path']);


            $file =$img;
            $type = Storage::disk($imgData['path']['driver'])->mimeType($imgData['path']['path']);
            $response = Response::make($file, 200)->header("Content-Type", $type);

            return $response;







        }

//            ->map(function ($ar){
//            $ar->path=json_decode($ar->path,true);
//            return $ar;
//        })->first()->count());

    }


}
