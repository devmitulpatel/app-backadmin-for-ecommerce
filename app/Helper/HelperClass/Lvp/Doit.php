<?php


namespace App\Helper\HelperClass\Lvp;


use App\Model\Lvp\Category;
use App\Model\VideoApp\Frame;
use App\Model\VideoApp\Image;
use App\Model\VideoApp\Ringtone;
use App\Model\VideoApp\RingtoneCat;
use App\Model\VideoApp\Sticker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use function GuzzleHttp\json_decode;

class Doit
{
    public static function getFileExt($url){
        $u=parse_url ($url);

        $uExplode=explode('/',$u['path']);
        $uExplode=explode('.',end($uExplode));
        return end($uExplode);
    }

    public static function makeUrlSafe($url){
      //  $url='http://skyinfotechdeveloper.com/musicbit_video/category/Old Hit.png';
        $exUrl1=explode('//',$url);
        $onlyUrl=end($exUrl1);
        $exUrl2=explode('/',$onlyUrl);
        foreach ($exUrl2 as $k=>$v){
            $exUrl2[$k]=rawurlencode($v);
        }
        $imUrl1=implode('/',$exUrl2);
        $imUrl2=implode('//',[reset($exUrl1),$imUrl1]);
        var_dump($imUrl2);
        return $imUrl2;
    }

    public static function saveFileFromUrl($url,$folder,&$filename,$urlCheck=false,$withExtension=false,$disk='lvp'){


       if($urlCheck)$url=self::makeUrlSafe ($url);

        $code=Str::uuid();
        $fileExtetion=self::getFileExt($url);

        if(!$withExtension)$filename=implode('.',[($filename=='')?$code:$filename,$fileExtetion]);
        Storage::disk('lvp')->put(implode(DS,[$folder,$filename]), '');
        $location=storage_path(implode(DS,['lvp','upload',$folder,$filename]));
        $file = fopen($location, 'w+');
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FILE           => $file,
            CURLOPT_TIMEOUT        => 50,
            CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $gotFile=($response)?$response:false;
        $try=1;
        while(!$gotFile){

            var_dump("tring to get ".$filename. " for ".$try."from method");
            //sleep(15);
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL            => $url,
//  CURLOPT_BINARYTRANSFER => 1, --- No effect from PHP 5.1.3
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_FILE           => $file,
                CURLOPT_TIMEOUT        => 50,
                CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
            ]);
            $response = curl_exec($curl);
            $gotFile=($response)?$response:false;
            curl_close($curl);
            $try=$try+1;

        }


        if($response===false) Storage::disk($disk)->delete(implode(DS,[$folder,$filename]));
        return $response;

    }


    public static function importData(){
        set_time_limit(0);



        $path=app_path(implode('\\',['Helper','HelperClass','Lvp','cat.json']));




        $file=json_decode(file_get_contents($path),true);

        $importData=$file['result'];

        $importData=array_values(collect($importData)->sortBy('category_id')->toArray());


        $cat=$importData;
        $cm=getModel(Category::class);
        $po=[];
        $debug=true;

        if(!$debug)foreach ($cat as $c){
            //  dd($c);
            $rowData=[];
            $filename=$c['category_name'];
            $imgGot=self::saveFileFromUrl($c['category_image'],'category',$filename);
            $try=1;
            while(!$imgGot){
                var_dump("tring to get ".$c['category_name']. " for ".$try);
                sleep(15);
                $imgGot=self::saveFileFromUrl($c['category_image'],'category',$filename);
                $try=$try+1;
            }

            $rowData['id']=$c['category_id'];
            $rowData['category_name']=$c['category_name'];
            $rowData['category_image']= implode('/',['category',$filename]) ;
            $rowData['status']=$c['status '];
            $po['category'][$c['category_name']]=$cm->insert($rowData);

            var_dump($c['category_name']);


        }


        $url="http://skyinfotechdeveloper.com/musicbit_video/video_api.php?category_id=";

        $allCat=$cm->get()->toArray();
        //dd($allCat);
        $alljson=Storage::disk('lvp')->allFiles('videoJson');



        foreach ($allCat as  $c){

            $json=file_get_contents(storage_path(implode(DS,['lvp','upload','videoJson',$c['category_name'].".json"])) );
            $vData=json_decode($json,true);


            foreach ($vData['result'] as $v){

                $code=Str::uuid();


                $demoExt=self::getFileExt($v['demo_video_url']);
                $thumbExt=self::getFileExt($v['thumbnail']);
                $videoExt=self::getFileExt($v['video_url']);
                $overlyExt=self::getFileExt($v['overlay_gg']);
                $waterExt=self::getFileExt($v['watermark']);

                $demoFilename=implode('.',[$code,$demoExt]) ;
                $thumbFilename=implode('.',[$code,$thumbExt]) ;
                $videoFilename=implode('.',[$code,$videoExt]) ;
                $overlyFilename=implode('.',[$code,$overlyExt]) ;
                $waterFilename=implode('.',[$code,$waterExt]) ;


                $demoUrl=implode('/',['videos','demos' ,$demoFilename] );
                $thumbUrl=implode('/',['videos','thumbnail',$thumbFilename]);
                $videoUrl=implode('/',['videos','videos', $videoFilename]);
                $overlyUrl=implode('/',['videos','overlay',$overlyFilename]);
                $waterUrl=implode('/',['videos','watermark',$waterFilename]);


                self::saveFileFromUrl($v['demo_video_url'],implode(DS,['videos','demos']),$demoFilename,true);
                self::saveFileFromUrl($v['demo_video_url'],implode(DS,['videos','thumbnail']),$thumbFilename,true);
                self::saveFileFromUrl($v['demo_video_url'],implode(DS,['videos','videos']),$videoFilename,true);
                self::saveFileFromUrl($v['demo_video_url'],implode(DS,['videos','overlay']),$overlyFilename,true);
                self::saveFileFromUrl($v['demo_video_url'],implode(DS,['videos','watermark']),$waterFilename,true);

                dd('ok');
                $vRawData=[
                    'video_name'=>$v['video_name'],
                    'thumbnail'=>$v['thumbnail'],
                    'demo_video_url'=>$v['demo_video_url'],
                    'video_url'=>$v['video_url'],
                    'video_upload_time'=>$v['video_upload_time'],
                    'video_view'=>$v['video_view'],
                    'video_like'=>$v['video_like'],
                    'video_share'=>$v['video_share'],
                    'overlay_gg'=>$v['overlay_gg'],
                    'watermark'=>$v['watermark'],
                ];


                dd($vRawData);


            }



        }


        dd($po);


        return true;

    }




}
