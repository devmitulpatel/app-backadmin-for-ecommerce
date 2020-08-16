<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\SaveProduct;
use App\Model\Product\ProductImages;
use App\Model\Settings\Product\Extra_Field;
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



        $cat=(array_key_exists('cat',$input))? $input['cat'] :0;
        $scat=(array_key_exists('scat',$input))? $input['scat'] :0;
        $this->makeExtraField($cat,$scat,$input);

        $this->saveImageFromReq(['pimg'],['pimgs'],$r,$input);
        return saveToModel(\App\Model\Product\Product::class,$r,'Product',$input);




    }


    public function uploadImage(Request $r){

        if($r->hasFile('upload') && $r->file('upload')->isValid()){
            $code=$this->getSafeFileCode();
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



    private function saveImageFromReq($column=[],$multiFileColumn=[],$r,&$input){
        $outArray=[];


        if(count($column)>0)foreach ($column as $c){
            if($r->hasFile($c) && $r->file($c)->isValid()) {
                $code = $this->getSafeFileCode();
                $ext = $r->$c->extension();
                $filename = implode('.', [$code, $ext]);
                $driver = 'product';
                $path = $r->$c->storeAs('productImage', $filename, $driver);
                $link = $this->addImageEntryToDB($filename, $driver, $path);
                $explodeLink=explode('/',$link);
                unset($explodeLink[0]);
                unset($explodeLink[1]);
                unset($explodeLink[2]);
                $link=implode('/',$explodeLink);
                $input[$c] = $link;
            }

        }

        if(count($multiFileColumn)>0)foreach ($multiFileColumn as $c){
          //  dd($input);

            if(array_key_exists($c,$input))foreach ($input[$c] as $k=>$file){


                if($r->hasFile(implode('.',[$c,$k])) && $r->file(implode('.',[$c,$k]))->isValid()) {
                    $code = $this->getSafeFileCode();
                    $ext = $r->$c[$k]->extension();
                    $filename = implode('.', [$code, $ext]);
                    $driver = 'product';
                    $path = $r->$c[$k]->storeAs('productImage', $filename, $driver);
                    $link = $this->addImageEntryToDB($filename, $driver, $path);
                    $explodeLink=explode('/',$link);
                    unset($explodeLink[0]);
                    unset($explodeLink[1]);
                    unset($explodeLink[2]);
                    $link=implode('/',$explodeLink);
                    $input[$c][$k] = $link;
                }



            }

            $input[$c]=collect($input[$c])->toJson();





        }


        return $input;

    }

    private function getSafeFileCode($length=5){
        $code=Str::slug(Str::random(5));
        $m=getModel(ProductImages::class);

        while($m->where('code')->get()->count()){
        $code=Str::slug(Str::random(5));
        }
        return $code;
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
    private function getExtraFields($cat,$scat){

        $EFModel=getModel(Extra_Field::class);

        $EFDataWithub=$EFModel->where('cat',$cat)->where('scat',$scat)->get();
        $EFDataOnlyMaster=$EFModel->where('cat',0)->where('scat',0)->get();
        $EFDataOnlyCat=$EFModel->where('cat',$cat)->where('scat',0)->get();

        $d1=($EFDataOnlyMaster->count()>0)?$EFDataOnlyMaster->toArray():[];
        $d2=($EFDataOnlyCat->count()>0)?$EFDataOnlyCat->toArray():[];
        $d3=($EFDataWithub->count()>0)?$EFDataWithub->toArray():[];


        return array_merge($d1,$d2,$d3);
    }

    private function makeExtraField($cat,$scat,&$input,$column="extraFields"){
        $allFields=$this->getExtraFields($cat,$scat);
        if(count($allFields)>0){
            $finalExtraFields=[];
            foreach ($allFields as $f){
                if( array_key_exists($f['name'],$input)){
                    $finalExtraFields[$f['name']]=$input[$f['name']];
                    unset($input[$f['name']]);
                }
            }
            $input[$column]=collect($finalExtraFields)->toJson();

            return $input;
        }

    }


}
