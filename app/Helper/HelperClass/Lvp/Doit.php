<?php


namespace App\Helper\HelperClass\Lvp;


use App\Model\Lvp\Category;
use App\Model\Lvp\Videos;
use App\Model\VideoApp\Frame;
use App\Model\VideoApp\Image;
use App\Model\VideoApp\Ringtone;
use App\Model\VideoApp\RingtoneCat;
use App\Model\VideoApp\Sticker;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use function GuzzleHttp\json_decode;

class Doit
{

    public static function getFile($data){
        $r=$data['r'];
        $input=$r->all();

        $imgData=[
            'path'=>$input['file'],
            'driver'=>$input['driver'],
        ];


        $img=Storage::disk($imgData['driver'])->get($imgData['path']);

        $file =$img;
        $type = Storage::disk($imgData['driver'])->mimeType($imgData['path']);
        $response = Response::make($file, 200)->header("Content-Type", $type);

        return $response;
    }

    public static function getFileExt($url){
        $u=parse_url($url);

        $uExplode=explode('/',$u['path']);
        $uExplode=explode('.',end($uExplode));
        return end($uExplode);

    }

    public static function getTemplateByCatId($data){
        $input=$data['r']->all();

        if(array_key_exists('cat_id',$input)){
            $v=new Videos();

            $founData=$v->select(['id','title','height','width','zip','is_hot','video_url','thumb_url','zip_url','is_new'])->where('cat_id',$input['cat_id'])->get();

            if($founData->count()<1)goto mserror;

            $data=[
                'status'=>true,
                "message"=> "Templates",
                'data'=>[
                    'templates'=>$founData->toArray(),
                ]
            ];

        }else{
            mserror:

            $data=[
                'status'=>false,
                "message"=> "Templates",
                'data'=>[
                ]
            ];

        }


        return response()->json($data);

        dd($data['r']->all());

    }

    public static function getTemplate($data){
        //dd($data);
        $c=new Category();
        $v=new Videos();
        $data=[
            'status'=>true,
            "message"=> "Templates",
            'data'=>[
                'templates'=>$v->select(['id','title','height','width','zip','is_hot','video_url','thumb_url','zip_url','is_new'])->get()->toArray(),
                'categories'=>$c->select(['id','name','sort_by','image_url'])->get()->toArray(),
            ]
        ];
        return response()->json($data);

    }
    public static function test(){

        $model=new Videos();
        $m=$model->all();


        $duplicateZip=[];

        foreach ($m as $v) {
                $count=$model->where('zip',$v->zip)->get()->count();
            if($count>1){
                $duplicateZip[$v->zip]['count']=$count;
                $duplicateZip[$v->zip]['id'][]=$v->id;
            }
        }

        $process=[];
        foreach ($duplicateZip as $k=>$i){

            unset($i['id'][0]);

            foreach ($i['id'] as $v){

                $foundRaw=$model->where('id',$v)->get()->first()->toArray();

                $files=[
                    'video_url','thumb_url','zip_url'
                ];

                foreach ($files as $f){

                    $filePath=$foundRaw[$f];

                    if(Storage::disk('lvp')->exists($filePath) ){
                        $process[$k]['fileDeleted'][$f]=Storage::disk('lvp')->delete($filePath);
                    }

                }

                $process[$k]['dbEntryDeleted'] = $model->where('id',$v)->delete();



            }



        }


        dd($process);







          //  dd($allFile);

            dd(array_sum($allFile));


            $file=json_decode(file_get_contents($file));

            dd($file);



    }

    public static function makeUrlSafe($url){
      //  $url='http://skyinfotechdeveloper.com/musicbit_video/category/Old Hit.png';
        $exUrl1=explode('//',$url);
        $onlyUrl=end($exUrl1);
        $exUrl2=explode('/',$onlyUrl);
        $port=80;

        $exUrl3=explode(':',reset($exUrl2));

        if(count($exUrl3)==2){
            $exUrl2[0]=reset($exUrl3);
            if(end($exUrl3)!=$port)$port=end($exUrl3);
        }



        foreach ($exUrl2 as $k=>$v){
            $exUrl2[$k]=rawurlencode($v);
        }

        if($port!=80){
            $exUrl2[0]=implode(':',[$exUrl2[0],$port]);
        }

        $imUrl1=implode('/',$exUrl2);
        $imUrl2=implode('//',[reset($exUrl1),$imUrl1]);
       // var_dump($imUrl2);
        return $imUrl2;
    }

    public static function saveFileFromUrl($url,$folder,&$filename,$urlCheck=false,$withExtension=false,$type='GET',$header=[],$disk='lvp'){


       if($urlCheck)$url=self::makeUrlSafe ($url);
        var_dump('downloading started from '.$url);
        $code=Str::uuid();
        $fileExtetion=self::getFileExt($url);
   //     dd($url);
        if(!$withExtension)$filename=implode('.',[($filename=='')?$code:$filename,$fileExtetion]);

        Storage::disk('lvp')->put(implode(DS,[$folder,$filename]), '');
        $location=storage_path(implode(DS,['lvp','upload',$folder,$filename]));
        $file = fopen($location, 'w+');
        $curl = curl_init();


        $curlConfig=[
            CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FILE           => $file,
            CURLOPT_TIMEOUT        => 50,
            CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
            CURLOPT_HTTPHEADER     => $header
        ];
        if(strtolower($type)=='post'){
            $curlConfig[CURLOPT_POST]=true;
        }
        curl_setopt_array($curl, $curlConfig);



        $response = curl_exec($curl);
        curl_close($curl);
        $gotFile=($response)?$response:false;
        $try=1;
        while(!$gotFile && $try>50){

            var_dump("tring to get ".$filename. " for ".$try."from method");
            //sleep(15);
            $curl = curl_init();

            curl_setopt_array($curl, $curlConfig);
            $response = curl_exec($curl);
            $gotFile=($response)?$response:false;
            curl_close($curl);
            $try=$try+1;

        }

        if(!$gotFile && $try>50){
            var_dump('manaully download file link: '.$url.' and save file name filename'. $filename);
            $response=true;
        }

        if($response===false) Storage::disk($disk)->delete(implode(DS,[$folder,$filename]));
        return $response;

    }


    public static function importData(){
        set_time_limit(0);



        $path=app_path(implode('\\',['Helper','HelperClass','Lvp','cat.json']));




        $file=json_decode(file_get_contents($path),true);


        $importData=$file;

        $importData=array_values(collect($importData)->sortBy('category_id')->toArray());


        $cat=$importData;
        $cm=getModel(Category::class);
        $po=[];
        $debug=false;

        if(!$debug)foreach ($cat as $c){
            //  dd($c);
            $rowData=[];
            $filename=$c['name'];
            $imgGot=self::saveFileFromUrl($c['image_url'],'category',$filename);

            $rowData['id']=$c['id'];
            $rowData['name']=$c['name'];
            $rowData['sort_by']=$c['sort_by'];
            $rowData['image_url']= implode('/',['category',$filename]) ;
            $po['category'][$c['name']]=$cm->insert($rowData);

            var_dump($c['name']);


        }


        $url="https://api.superherowall.in/api/v3/get-cat-templates?cat_id=";

        $allCat=$cm->get()->toArray();

        $alljson=Storage::disk('lvp')->allFiles('videoJson');
        $vm=getModel(Videos::class);


        foreach ($allCat as  $c){

            if(false) {


                $url2 = implode('', [$url, $c['id']]);
                $filename = implode('.', [$c['name'], 'json']);
                $headers = [
                    'Authorization' => 'aWpVLKDhhSXJlszc25aWXlRMmFrQjhUBKdsgeYoNpdgnpEdzU36KsOE4NnJMjsgyShdfnYWVFZx2GWhxbZk5c34d06eb3a'
                ];
                self::saveFileFromUrl($url2, 'videoJson', $filename, false, true, 'post', $headers);
            }
            if(true && $c['name']!='Popular'&& $c['name']!='Latest'){


    $json=file_get_contents(storage_path(implode(DS,['lvp','upload','videoJson',$c['name'].".json"])) );

    $vData=json_decode($json,true);



    foreach ($vData['data']['templates'] as $v){

       // dd($v);

        $code=Str::uuid();


        $thumbExt=self::getFileExt($v['thumb_url']);
        $videoExt=self::getFileExt($v['video_url']);
        $zipExt=self::getFileExt($v['zip_url']);


        $thumbFilename=implode('.',[$code,$thumbExt]) ;
        $videoFilename=implode('.',[$code,$videoExt]) ;
        $zipFilename=implode('.',[$code,$zipExt]) ;



        $thumbUrl  =implode('/',['videos','thumbnail',$thumbFilename]);
        $videoUrl=implode('/',['videos','videos', $videoFilename]);
        $zipUrl=implode('/',['videos','zip',$zipFilename]);



        self::saveFileFromUrl($v['thumb_url'],implode(DS,['videos','thumbnail']),$thumbFilename,false,true);
        self::saveFileFromUrl($v['video_url'],implode(DS,['videos','videos']),$videoFilename,false,true);
        self::saveFileFromUrl($v['zip_url'],implode(DS,['videos','zip']),$zipFilename,false,true);

        $vRawData=[
            'cat_id'=>$c['id'],
            'title'=>$v['title'],
            'height'=>$v['height'],
            'width'=>$v['width'],
            'zip'=>$v['zip'],
            'is_hot'=>$v['is_hot'],
            'video_url'=>$videoUrl,
            'thumb_url'=>$thumbUrl,
            'zip_url'=>$zipUrl,
            'is_new'=>$v['is_new'],
        ];
       // dd($vm->insert($vRawData));
        var_dump("Downloaded ".$v['title']);


        $po['video'][$c['id']][$v['title']] = $vm->insert($vRawData);


    }

}





        }


        dd($po);


        return true;

    }




}
