<?php

use App\Helper\HelperClass\Img\Doit as ImgDoit;
use App\Helper\HelperClass\Lvp\Doit as LvpDoit;
use App\Helper\Img\Doit;
use App\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use \App\Model\Settings\Product\Units;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/', function () {
//    return view('welcome');
//});




Route::get('/test_dr',function (){


    $allFiles=\Illuminate\Support\Facades\Storage::disk('dr')->allFiles('data');

    unset($allFiles[0]);
    unset($allFiles[1]);
    unset($allFiles[2]);
    $dataO=[];
    $manager = new ImageManager(array('driver' => 'gd'));
    $baseImg=$manager->canvas(1440,1440);

    foreach($allFiles as $fk=>$f){
        $filepath=storage_path(implode(DS,['dr',$f]));

        $type=explode('/',$f);
        $type=explode('.',end($type));
        $type=reset($type);

        $vData=[];
        $data=Excel::import(new \App\Imports\DrImport($vData), $filepath);
        //   dd(Excel::import(new \App\Imports\DrImport(), $filepath));
        $clumn=[
            'name',
//            'zone',
//            'region',
            'place',
            'speciality'
        ];

        foreach ($vData as $k=>$d){
            if($k>0){
                $dataO[$type][$k]=[];
                foreach ($clumn as $k2=>$c){
                    $dataO[$type][$k][$c]=$d[$k2];
                }

                $dataO[$type][$k]['photo']=implode(DS,['dr',$type,$dataO[$type][$k]['name'].".jpg"]);
            }
        }





    }



    $path=storage_path(implode(DS,['dr','b.png']));

    $fontpath2=storage_path(implode(DS,['dr','3.otf']));
    $manager = new ImageManager(array('driver' => 'gd'));

    $layer1=$manager->make($path);
    //
    foreach ($dataO as $mt=>$t){

      //  dd($t);

        foreach ($t as $dr){
            $mainCanvas=$manager->canvas(1440,1440);
            $photo=storage_path($dr['photo']);

            $photoImage = $manager->make($photo);

            $photoD['w']=$photoImage->getWidth();
            $photoD['h']=$photoImage->getHeight();
            $target=1348;

            $v_fact = $target / $photoD['h'];
            $h_fact = $target / $photoD['w'];



            $photoImage->resize(null,$target,function ($constraint) {
                $constraint->aspectRatio();
            });
            $mainCanvas->insert($photoImage,'center');
            $mainCanvas->insert($layer1,'center');

            $mainCanvas->text($dr['name'],720,1100,function ($f)use($fontpath2){
                $f->file($fontpath2);
                $f->size(48);
                $f->color('rgba(255,255,255,0.8)');
                $f->align('center');
                $f->valign('center');
                //   $f->angle(45);

            });



            $text2='';
            if($dr['place']!==null)$text2.=$dr['place'];
            if($dr['speciality']!==null)$text2.=", ".$dr['speciality'];

            $mainCanvas->text($text2,720,1150,function ($f)use($fontpath2){
                $f->file($fontpath2);
                $f->size(38);
                $f->color('rgba(255,255,255,0.8)');
                $f->align('center');
                $f->valign('center');
           });
            $filename=implode('.',[$dr['name'],'png']);

            $savepath=storage_path(implode(DS,['dr','final',$mt,$filename]));
            var_dump($filename);
            $mainCanvas->save($savepath);


        }


    }
    dd('allok');
    return $mainCanvas->response();
    dd($dataO);

    $path=storage_path(implode(DS,['lvp','upload','sample','b.png']));
    $path2=storage_path(implode(DS,['lvp','upload','sample','p.jpeg']));
    $fontpath2=storage_path(implode(DS,['lvp','upload','sample','3.ttf']));

    $drname="Dr. Sample Name";
    $phonenumber="+91 123456789";
    $from="          From
Classy Technosoft";

    $baseClass=new ImgDoit(1,$path2,['name'=>$drname,'number'=>$phonenumber,'from'=>$from]);

    return $baseClass->make()->save(storage_path(implode(DS,['dr','sample'])),'btest2.png');


    //    $imgname=\Illuminate\Support\Facades\Storage::disk('lvp')->get('category/Anniversary.png');
//
//    $path=storage_path(implode(DS,['lvp','upload','sample','1.jpg']));
//    $path2=storage_path(implode(DS,['lvp','upload','sample','2.png']));
//
//
//   // dd($path);
//
//    header ('Content-Type: image/png');
////    $im = imagecreatetruecolor(250, 250)
////    or die('Cannot Initialize new GD image stream');
//    $im = imagecreatefromjpeg($path)
//    or die('Cannot Initialize new GD image stream');
//
//    imageAlphaBlending($im, true);
//    imageSaveAlpha($im, true);
//    imagescale ($im,450,120);
//    $im2 = imagecreatefrompng($path2)
//    or die('Cannot Initialize new GD image stream');
//    imageAlphaBlending($im2, true);
//    imageSaveAlpha($im2, true);
//
//    $baseW=imagesx ($im);
//    $baseH=imagesy ($im);
//
//    $overlyW=imagesx ($im2);
//    $overlyH=imagesy ($im2);
//
//
//    $locationW=($baseW/2)+($overlyW/2);
//    $locationH=($baseH/2)+($overlyH/2);
//
//    $scale=1;
//
//    imagecopymerge($im, $im2, $locationW, $locationH, 100, 0, $overlyW*$scale, $overlyH*$scale, 100);
//    //$im3 = imagecreate(450,450);
//
//   // imagecopyresized($im3, $im, 100,100, 0, 0, 450, 450, $baseW, $baseH);
//    //$background = imagecolorallocate($im, 255, 0, 0);
//    //$text_color = imagecolorallocate($im, 233, 14, 91);
//
//    //$im  = imagecreatetruecolor(150, 30);
////   s $bgc = imagecolorallocate($im, 255, 255, 255);
////    $tc  = imagecolorallocate($im, 0, 0, 0);
//
//    //imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
//
//   //imagestring($im, 1, 5, 5, 'Error loading ' . $path, $tc);
//
//
//    $var=imagepng($im);
//
//    imagedestroy($im);
//    dd($var);

});



Route::get('/test_lvp',function (){



    $path=storage_path(implode(DS,['lvp','upload','sample','b.png']));
    $path2=storage_path(implode(DS,['lvp','upload','sample','p.jpeg']));
    $fontpath2=storage_path(implode(DS,['lvp','upload','sample','3.ttf']));

    $drname="Dr. Sample Name";
    $phonenumber="+91 123456789";
    $from="          From
Classy Technosoft";
    $path=storage_path(implode(DS,['dr','p.jpg']));
    $path2=storage_path(implode(DS,['dr','b.png']));
    $fontpath2=storage_path(implode(DS,['lvp','upload','sample','3.ttf']));

    $baseClass=new ImgDoit(1,$path2,['name'=>$drname,'number'=>$phonenumber,'from'=>$from]);

  // return $baseClass->make()->save(storage_path(implode(DS,['dr','sample'])),'btest2.png');

    $path=storage_path(implode(DS,['dr','p.jpg']));
    $path2=storage_path(implode(DS,['dr','b.png']));
    $fontpath2=storage_path(implode(DS,['dr','3.otf']));

    $scale=1;
    $watermarkBorderWidth=10;
    // create an image manager instance with favored driver
    $manager = new ImageManager(array('driver' => 'gd'));
    $img=$manager->make($path);
    $watermark=$manager->make($path2);


    $baseW=$img->width();
    $baseH=$img->height();

    $baseImg=$manager->canvas(1440,1440);
    $watermark->resize(1440,1440);
    $fix=5;

 //   $watermark->resize(145,156);
    $img->resize(1048,1048);
    $baseImg->insert($img,'center');
    $baseImg->insert($path2,'center');

    $baseImg->text($drname,720,1150,function ($f)use($fontpath2){
        $f->file($fontpath2);
        $f->size(48);
        $f->color('rgba(255,255,255,0.8)');
        $f->align('center');
        $f->valign('center');
     //   $f->angle(45);

    });

    $baseImg->text('speciality',720,1200,function ($f)use($fontpath2){
        $f->file($fontpath2);
        $f->size(38);
        $f->color('rgba(255,255,255,0.8)');
        $f->align('center');
        $f->valign('center');
        //   $f->angle(45);

    });


//    $baseImg->rectangle(0, 0, $watermarkW*$scale, $watermarkH*$scale, function ($draw)use ($watermarkBorderWidth) {
//        $draw->background('rgba(0,0,0,0.1)');
//        $draw->border($watermarkBorderWidth, 'rgba(0,0,0,0.5)');
//    })->insert($watermark,'center');

//    $img->resize($baseW*$scale,$baseH*$scale)->insert($baseImg,'left-top',42,42);
//    $img->text($drname,58,220,function ($f)use($fontpath2){
//        $f->file($fontpath2);
//        $f->size(18);
//        $f->color('rgba(0,0,0,0.8)');
//        $f->align('left');
//        $f->valign('top');
//     //   $f->angle(45);
//
//    });
//
//    $img->text($from,$baseW/2,$baseH-20,function ($f)use($fontpath2){
//        $f->file($fontpath2);
//        $f->align('center');
//        $f->size(18);
//        $f->color('rgba(0,0,0,0.8)');
//        $f->valign('bottom');
//        //   $f->angle(45);
//
//    });
//
//
//    $img->text($phonenumber,58,248,function ($f)use($fontpath2){
//        $f->file($fontpath2);
//        $f->align('left');
//        $f->size(18);
//        $f->color('rgba(0,0,0,0.8)');
//        $f->valign('top');
//        //   $f->angle(45);
//
//    });
//




    header ('Content-Type: image/png');
    return $baseImg->response();


    //    $imgname=\Illuminate\Support\Facades\Storage::disk('lvp')->get('category/Anniversary.png');
//
//    $path=storage_path(implode(DS,['lvp','upload','sample','1.jpg']));
//    $path2=storage_path(implode(DS,['lvp','upload','sample','2.png']));
//
//
//   // dd($path);
//
//    header ('Content-Type: image/png');
////    $im = imagecreatetruecolor(250, 250)
////    or die('Cannot Initialize new GD image stream');
//    $im = imagecreatefromjpeg($path)
//    or die('Cannot Initialize new GD image stream');
//
//    imageAlphaBlending($im, true);
//    imageSaveAlpha($im, true);
//    imagescale ($im,450,120);
//    $im2 = imagecreatefrompng($path2)
//    or die('Cannot Initialize new GD image stream');
//    imageAlphaBlending($im2, true);
//    imageSaveAlpha($im2, true);
//
//    $baseW=imagesx ($im);
//    $baseH=imagesy ($im);
//
//    $overlyW=imagesx ($im2);
//    $overlyH=imagesy ($im2);
//
//
//    $locationW=($baseW/2)+($overlyW/2);
//    $locationH=($baseH/2)+($overlyH/2);
//
//    $scale=1;
//
//    imagecopymerge($im, $im2, $locationW, $locationH, 100, 0, $overlyW*$scale, $overlyH*$scale, 100);
//    //$im3 = imagecreate(450,450);
//
//   // imagecopyresized($im3, $im, 100,100, 0, 0, 450, 450, $baseW, $baseH);
//    //$background = imagecolorallocate($im, 255, 0, 0);
//    //$text_color = imagecolorallocate($im, 233, 14, 91);
//
//    //$im  = imagecreatetruecolor(150, 30);
////   s $bgc = imagecolorallocate($im, 255, 255, 255);
////    $tc  = imagecolorallocate($im, 0, 0, 0);
//
//    //imagefilledrectangle($im, 0, 0, 150, 30, $bgc);
//
//   //imagestring($im, 1, 5, 5, 'Error loading ' . $path, $tc);
//
//
//    $var=imagepng($im);
//
//    imagedestroy($im);
//    dd($var);

});




if(false){
    Broadcast::routes();

    Route::get('/', function () {
        return view('layouts.front');


    });


    Route::get('/test5', function (Request $request) {

        dd(\Illuminate\Support\Facades\Auth::user()->getRememberToken());
        return view('vendor.passport.authorize')->with('client', []);


    });
    Route::get('/test2', function (Request $request) {

        session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'grant_type' => 'authaction_code',
            'client_id' => '91566191-9189-4220-826e-b0f36e63a426',
            'client_secret' => 'iVUpHnND2wGEBn4ct2LQiJjfj7iktpucMJ7AO4Jf',
            'redirect_uri' => redirect('/test3'),
            'response_type' => 200,
            'scope' => '',
            'state' => $state,
        ]);

        //  return redirect('/test?'.$query);
        return redirect('/oauth/authorize?' . $query);
    });


    Route::any('/test4', function (\Illuminate\Http\Request $r) {
        dd($r->all());
    });
    Route::any('/test3', function (\Illuminate\Http\Request $r) {
        session()->put('state', $state = Str::random(40));

        $query = http_build_query([
            'client_id' => '91566191-9189-4220-826e-b0f36e63a426',
            'redirect_uri' => redirect('/test4'),
            'response_type' => 'token',
            'client_secret' => 'iVUpHnND2wGEBn4ct2LQiJjfj7iktpucMJ7AO4Jf',
            'scope' => '',
            'state' => $state,
        ]);

        return redirect('oauth/authorize?' . $query);

    });
}
Route::any('videoapp/test',function (\Illuminate\Http\Request $r){


    $sd=getModel(\App\Model\VideoApp\Frame::class)->select(['name','imageUrl','thumbUrl','id'])->get()->toArray();

    $sd=array_map(function ($a){

        return array_values($a);
    },$sd);

    $data=[
        'data'=>$sd
    ];
  //  dd($data);
        return response()->json($data);



//    r('p','zdemo',[\App\Http\Controllers\Product\Product::class,'index']);

    return view('layouts.app');





})->middleware('api');



\App\Helper\HelperClass\AppScopedRoutes::routes();




