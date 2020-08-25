<?php

namespace Help\VideoApp;


use App\Model\VideoApp\Frame;
use App\Model\VideoApp\Image;
use App\Model\VideoApp\Ringtone;
use App\Model\VideoApp\RingtoneCat;
use App\Model\VideoApp\Sticker;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Doit
{
    public static function editDataIntToDb($r){
        $allInput=$r->all();

        $type=$allInput['formtype'];

        $msg=[];
        $er=[];
        switch ($type){

            case 0:

                $data=[
                    'id'=>$allInput['id'],
                    'name'=>$allInput['name'],
                    'imageUrl'=>$allInput['imageUrl'],
                    'thumbUrl'=>$allInput['thumbUrl'],
                    'updated_at'=>now()
                ];
                $prcess[self::editFrame($data,$r)][]='Frame update to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Frame not Updated';
                }else {
                    $msg[]='Frame Updated';
                }

                break;

            case 1:

                //  dd($allInput);
                $data=[
                    'id'=>$allInput['id'],
                    'thumbUrl'=>$allInput['thumbUrl'],
                    'updated_at'=>now()
                ];
                $prcess[self::editImage($data,$r)][]='Images add to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Image not Updated';
                }else {
                    $msg[]='Image Updated';
                }


                break;

            case  2:
                $data=[
                    'id'=>$allInput['id'],
                    'name'=>$allInput['name'],
                    'thumbUrl'=>$allInput['thumbUrl'],
                    'updated_at'=>now()
                ];
                $prcess[self::editSticker($data,$r)][]='Sticker update to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Sticker not Updated';
                }else {
                    $msg[]='Sticker Updated';
                }

                break;
            case  3:
                $data=[
                    'id'=>$allInput['id'],
                    'name'=>$allInput['name'],
                    'type'=>$allInput['type'],
                    'mp3Url'=>$allInput['mp3Url'],
                    'updated_at'=>now()
                ];
                $prcess[self::editRingtone($data,$r)][]='Ringtone update to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Ringtone not Updated';
                }else {
                    $msg[]='Ringtone Updated';
                }

                break;
            case  4:
                $data=[
                    'id'=>$allInput['id'],
                    'name'=>$allInput['name'],
                    'icon'=>$allInput['icon'],
                    'updated_at'=>now()
                ];
                $prcess[self::editRingtoneCat($data,$r)][]='Ringtone Category update to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Ringtone Category not Updated';
                }else {
                    $msg[]='Ringtone Category Updated';
                }

                break;

        }


        if(count($er)>0){
            return throwError($er);
        }else{
            return throwData($msg);

        }


    }

    public static function deleteData($r){
        $inputs=$r->all();

         $typeMaster=[
            'frame'=>1,
            'image'=>2,
            'sticker'=>3,
            'ringtone'=>4,
            'ringtonecat'=>5,
        ];


        $type= (array_key_exists(strtolower($inputs['type']),$typeMaster))?$typeMaster[strtolower($inputs['type'])]:false ;
        $id=$inputs['id'];
        $msg=[];
        $er=[];
        $process=[];
        if($type!=false){


            switch ($type){

                case 1:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteFrame($data)][]='Frame add to DB';
                    if(array_key_exists(0,$process) && count($process)>0){
                        $er[]='Frame not deleted';
                    }else {
                        $msg[]='Frame Deleted';
                    }

                    break;
                case 2:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteImage($data)][]='Image add to DB';
                    if(array_key_exists(0,$process) && count($process)>0){
                        $er[]='Image not deleted';
                    }else {
                        $msg[]='Image Deleted';
                    }

                case 3:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteSticker($data)][]='Sticker add to DB';
                    if(array_key_exists(0,$process) && count($process)>0){
                        $er[]='Sticker not deleted';
                    }else {
                        $msg[]='Sticker Deleted';
                    }

                    break;
                case 4:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteRingtone($data)][]='Ringtone add to DB';
                    if(array_key_exists(0,$process) && count($process)>0){
                        $er[]='Ringtone not deleted';
                    }else {
                        $msg[]='Ringtone Deleted';
                    }

                    break;
                case 5:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteRingtoneCat($data)][]='Ringtone Category add to DB';
                    if(array_key_exists(0,$process) && count($process)>0){
                        $er[]='Ringtone Category not deleted';
                    }else {
                        $msg[]='Ringtone Category Deleted';
                    }

                    break;


            }

            if(count($er)>0){
                return throwError($er);
            }else{
                return throwData($msg);

            }


        }else{

        }

    }

    public static function getData($r){

        $typeMaster=[
            'frame'=>1,
            'image'=>2,
            'sticker'=>3,
            'ringtone'=>4,
            'ringtonecat'=>5,
        ];
        $input=$r->all();
        $type=$input['type']??false;

        if($type!=false && array_key_exists(strtolower($type),$typeMaster)){

            switch ($typeMaster[strtolower($type)]){
                case 1:
                    $m=getModel(Frame::class);
                    return  throwData($m->all());
                    break;
                case 2:
                    $m=getModel(Image::class);
                    return  throwData($m->all());
                    break;
                case 3:
                    $m=getModel(Sticker::class);
                    return  throwData($m->all());
                    break;
                case 4:
                    $m=getModel(Ringtone::class);
                    return  throwData($m->all());
                    break;
                case 5:
                    $m=getModel(RingtoneCat::class);
                    return  throwData($m->all());
                    break;
            }

        }
        return throwError(['Invalid Request']);

    }

    public static function getFile($r){

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


    public static function ProcessFormData($r){


        $allInput=$r->all();

        $type=$allInput['formtype'];

        $msg=[];
        $er=[];
        switch ($type){

            case 0:

                $data=[
                    'name'=>$allInput['name'],
                    'imageUrl'=>$allInput['imageUrl'],
                    'thumbUrl'=>$allInput['thumbUrl'],
                    'status'=>1,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ];
                $prcess[self::addFrame($data,$r)][]='Frame add to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Frame not added';
                }else {
                    $msg[]='Frame added';
                }

                break;

            case 1:

               //  dd($allInput);
                $data=[

                    'thumbUrl'=>$allInput['thumbUrl'],
                    'status'=>1,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ];
                $prcess[self::addImage($data,$r)][]='Images add to DB';
                 if(array_key_exists(0,$prcess) && count($prcess)>0){
                     $er[]='Image not added';
                 }else {
                     $msg[]='Image added';
                 }


                break;

            case 2:

                $data=[
                    'name'=>$allInput['name'],
                    'thumbUrl'=>$allInput['thumbUrl'],
                    'status'=>1,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ];
                $prcess[self::addSticker($data,$r)][]='Sticker add to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Sticker not added';
                }else {
                    $msg[]='Sticker added';
                }
                break;
            case 3:

                $data=[
                    'name'=>$allInput['name'],
                    'mp3Url'=>$allInput['mp3Url'],
                    'thumbUrl'=>$allInput['thumbUrl'],
                    'type'=>$allInput['type'],
                    'status'=>1,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ];
                $prcess[self::addRingtone($data,$r)][]='Ringtone add to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Ringtone not added';
                }else {
                    $msg[]='Ringtone added';
                }
                break;
            case 4:

                $data=[
                    'name'=>$allInput['name'],
                    'icon'=>$allInput['icon'],
                    'status'=>1,
                    'created_at'=>now(),
                    'updated_at'=>now()
                ];
                $prcess[self::addRingtoneCat($data,$r)][]='Ringtone Category add to DB';
                if(array_key_exists(0,$prcess) && count($prcess)>0){
                    $er[]='Ringtone Category not added';
                }else {
                    $msg[]='Ringtone Category added';
                }
                break;

        }


        if(count($er)>0){
            return throwError($er);
        }else{
            return throwData($msg);

        }






    }


    public static function addFrame($data,$r){
        $m=getModel(Frame::class);
        $file=['imageUrl','thumbUrl'];

        $filepaths=[];

        $fData=[];

        foreach ($file as $f){


            $code = Str::uuid();
            $ext = $r->$f->extension();
            $filename = implode('.', [$code, $ext]);
            $driver = 'videoapp';
            $filepaths[$f] = $r->$f->storeAs('frames', $filename, $driver);

        }

        foreach ($data as $k=>$v){

            if(array_key_exists($k,$filepaths)){
                $fData[$k]=$filepaths[$k];
            }else{
                $fData[$k]=$v;
            }

        }

        return $m->insert($fData);




    }
    public static function editFrame($identifier,$r){

        $m=getModel(Frame::class);
        $file=['imageUrl','thumbUrl'];
        // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();

        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){
                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);



                    if($r->hasFile($f)){
                        $process[Storage::disk($query['driver'])->delete($query['file'])][]='File update';
                        $code = Str::uuid();
                        $ext = $r->$f->extension();
                        $filename = implode('.', [$code, $ext]);
                        $driver = $query['driver'];
                        $filepaths[$f] = $r->$f->storeAs('frames', $filename, $driver);
                        $identifier[$f]=$filepaths[$f];
                    }else{
                        if(array_key_exists($f,$identifier))unset($identifier[$f]);
                    }
                }
            }

            if(array_key_exists('id',$identifier))unset($identifier['id']);
            if(array_key_exists('created_at',$identifier))unset($identifier['created_at']);

            $process[$row->first()->update($identifier)]='DB Entry Update';

            if(!array_key_exists(0,$process))return true;

        }
        return false;



    }
    public static function deleteFrame($identifier){
        $m=getModel(Frame::class);
        $file=['imageUrl','thumbUrl'];
       // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();
        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){

                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);
                    $process[Storage::disk($query['driver'])->delete($query['file'])][]='File Deleted';
                }

            }

            $process[$row->first()->delete()]='DB Entry Deleted';

            if(!array_key_exists(0,$process))return true;

        }
        return false;
        dd($row->count());


    }

    public static function addImage($data,$r){
        $m=getModel(Image::class);
        $file=['thumbUrl'];
        $fixname=['thumbUrl'=>'imageUrl'];

        $filepaths=[];

        $fData=[];

        foreach ($file as $f){
            $oldF=$f;
          //  if(array_key_exists($f,$fixname))$f=$fixname[$f];
            $code = Str::uuid();
            $ext = $r->$f->extension();
            $filename = implode('.', [$code, $ext]);
            $driver = 'videoapp';
            $filepaths[$oldF] = $r->$f->storeAs('images', $filename, $driver);
        }

        foreach ($data as $k=>$v){

            if(array_key_exists($k,$filepaths)){
                $fData[$k]=$filepaths[$k];
            }else{
                $fData[$k]=$v;
            }

        }

        return $m->insert($fData);
    }
    public static function editImage($identifier,$r){

        $m=getModel(Image::class);
        $file=['thumbUrl'];
        // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();

        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){
                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);

                    if($r->hasFile($f)){
                        $process[Storage::disk($query['driver'])->delete($query['file'])][]='File update';
                        $code = Str::uuid();
                        $ext = $r->$f->extension();
                        $filename = implode('.', [$code, $ext]);
                        $driver = $query['driver'];
                        $filepaths[$f] = $r->$f->storeAs('frames', $filename, $driver);
                        $identifier[$f]=$filepaths[$f];
                    }else{
                        if(array_key_exists($f,$identifier))unset($identifier[$f]);
                    }
                }
            }

            if(array_key_exists('id',$identifier))unset($identifier['id']);
            if(array_key_exists('created_at',$identifier))unset($identifier['created_at']);

            $process[$row->first()->update($identifier)]='DB Entry Update';

            if(!array_key_exists(0,$process))return true;

        }
        return false;

    }
    public static function deleteImage($identifier){

        $m=getModel(Image::class);
        $file=['thumbUrl'];
        // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();
        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){

                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);
                    $process[Storage::disk($query['driver'])->delete($query['file'])][]='File Deleted';
                }

            }

            $process[$row->first()->delete()]='DB Entry Deleted';

            if(!array_key_exists(0,$process))return true;

        }
        return false;

    }

    public static function addSticker($data,$r){

        $m=getModel(Sticker::class);
        $file=['thumbUrl'];

        $filepaths=[];

        $fData=[];

        foreach ($file as $f){


            $code = Str::uuid();
            $ext = $r->$f->extension();
            $filename = implode('.', [$code, $ext]);
            $driver = 'videoapp';
            $filepaths[$f] = $r->$f->storeAs('stickers', $filename, $driver);

        }

        foreach ($data as $k=>$v){

            if(array_key_exists($k,$filepaths)){
                $fData[$k]=$filepaths[$k];
            }else{
                $fData[$k]=$v;
            }

        }

        return $m->insert($fData);


    }
    public static function editSticker($identifier,$r){
        $m = getModel(Sticker::class);
        $file = ['thumbUrl'];
        // dd($identifier);
        $row = $m->where('id', $identifier['id'])->get();

        $process = [];
        if ($row->count() > 0) {

            $rawData = $row->first()->toArray();

            foreach ($file as $f) {
                if (array_key_exists($f, $rawData)) {
                    $query = [];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);

                    if ($r->hasFile($f)) {
                        $process[Storage::disk($query['driver'])->delete($query['file'])][] = 'File update';
                        $code = Str::uuid();
                        $ext = $r->$f->extension();
                        $filename = implode('.', [$code, $ext]);
                        $driver = $query['driver'];
                        $filepaths[$f] = $r->$f->storeAs('frames', $filename, $driver);
                        $identifier[$f] = $filepaths[$f];
                    }else{
                        if(array_key_exists($f,$identifier))unset($identifier[$f]);
                    }
                }
            }

            if (array_key_exists('id', $identifier)) unset($identifier['id']);
            if (array_key_exists('created_at', $identifier)) unset($identifier['created_at']);

            $process[$row->first()->update($identifier)] = 'DB Entry Update';

            if (!array_key_exists(0, $process)) return true;
        }
    }
    public static function deleteSticker($identifier){

        $m=getModel(Sticker::class);
        $file=['thumbUrl'];
        // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();
        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){

                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);
                    $process[Storage::disk($query['driver'])->delete($query['file'])][]='File Deleted';
                }

            }

            $process[$row->first()->delete()]='DB Entry Deleted';

            if(!array_key_exists(0,$process))return true;

        }
        return false;

    }

    public static function addRingtone($data,$r){

        $m=getModel(Ringtone::class);
        $file=['thumbUrl','mp3Url'];

        $filepaths=[];

        $fData=[];



        foreach ($file as $f){


            $code = Str::uuid();
            $ext = $r->$f->extension();
            $filename = implode('.', [$code, $ext]);
            $driver = 'videoapp';
            $filepaths[$f] = $r->$f->storeAs('ringtones', $filename, $driver);

        }

        foreach ($data as $k=>$v){

            if(array_key_exists($k,$filepaths)){
                $fData[$k]=$filepaths[$k];
            }else{
                $fData[$k]=$v;
            }

        }
      //  dd($fData);

        return $m->insert($fData);

    }
    public static function editRingtone($identifier,$r){

        $m = getModel(Ringtone::class);
        $file = ['mpeUrl','thumbUrl'];
        // dd($identifier);
        $row = $m->where('id', $identifier['id'])->get();

        $process = [];
        if ($row->count() > 0) {

            $rawData = $row->first()->toArray();

            foreach ($file as $f) {
                if (array_key_exists($f, $rawData)) {
                    $query = [];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);

                    if ($r->hasFile($f)) {
                        $process[Storage::disk($query['driver'])->delete($query['file'])][] = 'File update';
                        $code = Str::uuid();
                        $ext = $r->$f->extension();
                        $filename = implode('.', [$code, $ext]);
                        $driver = $query['driver'];
                        $filepaths[$f] = $r->$f->storeAs('frames', $filename, $driver);
                        $identifier[$f] = $filepaths[$f];
                    }else{
                        if(array_key_exists($f,$identifier))unset($identifier[$f]);
                    }
                }
            }

            if (array_key_exists('id', $identifier)) unset($identifier['id']);
            if (array_key_exists('created_at', $identifier)) unset($identifier['created_at']);

            $process[$row->first()->update($identifier)] = 'DB Entry Update';

            if (!array_key_exists(0, $process)) return true;

        }
    }
    public static function deleteRingtone($identifier){
        $m=getModel(Ringtone::class);
        $file=['icon'];
        // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();
        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){

                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);
                    $process[Storage::disk($query['driver'])->delete($query['file'])][]='File Deleted';
                }

            }

            $process[$row->first()->delete()]='DB Entry Deleted';

            if(!array_key_exists(0,$process))return true;

        }
        return false;
    }

    public static function addRingtoneCat($data,$r){

        $m=getModel(RingtoneCat::class);
        $file=['icon'];

        $filepaths=[];

        $fData=[];



        foreach ($file as $f){


            $code = Str::uuid();
            $ext = $r->$f->extension();
            $filename = implode('.', [$code, $ext]);
            $driver = 'videoapp';
            $filepaths[$f] = $r->$f->storeAs('ringtonesCat', $filename, $driver);

        }

        foreach ($data as $k=>$v){

            if(array_key_exists($k,$filepaths)){
                $fData[$k]=$filepaths[$k];
            }else{
                $fData[$k]=$v;
            }

        }
        //  dd($fData);

        return $m->insert($fData);
    }
    public static function editRingtoneCat($identifier,$r){

        $m = getModel(RingtoneCat::class);
        $file = ['icon'];
        // dd($identifier);
        $row = $m->where('id', $identifier['id'])->get();

        $process = [];
        if ($row->count() > 0) {

            $rawData = $row->first()->toArray();

            foreach ($file as $f) {
                if (array_key_exists($f, $rawData)) {
                    $query = [];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);

                    if ($r->hasFile($f)) {
                        $process[Storage::disk($query['driver'])->delete($query['file'])][] = 'File update';
                        $code = Str::uuid();
                        $ext = $r->$f->extension();
                        $filename = implode('.', [$code, $ext]);
                        $driver = $query['driver'];
                        $filepaths[$f] = $r->$f->storeAs('frames', $filename, $driver);
                        $identifier[$f] = $filepaths[$f];
                    }else{
                        if(array_key_exists($f,$identifier))unset($identifier[$f]);
                    }
                }
            }

            if (array_key_exists('id', $identifier)) unset($identifier['id']);
            if (array_key_exists('created_at', $identifier)) unset($identifier['created_at']);

            $process[$row->first()->update($identifier)] = 'DB Entry Update';

            if (!array_key_exists(0, $process)) return true;

    }
    }
    public static function deleteRingtoneCat($identifier){

        $m=getModel(RingtoneCat::class);
        $file=['icon'];
        // dd($identifier);
        $row=$m->where('id',$identifier['id'])->get();
        $process=[];
        if($row->count()>0){

            $rawData=$row->first()->toArray();

            foreach ($file as $f){

                if(array_key_exists($f,$rawData)){
                    $query=[];
                    parse_str(parse_url($rawData[$f], PHP_URL_QUERY), $query);
                    $process[Storage::disk($query['driver'])->delete($query['file'])][]='File Deleted';
                }

            }

            $process[$row->first()->delete()]='DB Entry Deleted';

            if(!array_key_exists(0,$process))return true;

        }
        return false;

    }


    public static function responseRingtone(){
        $m=getModel(Ringtone::class);
        $md=$m->select(['name','thumbUrl','type','mp3Url'])->get()->groupBy('type')->toArray();

        $m2=getModel(RingtoneCat::class)->all();
    //    dd($m2->where('id',));
        $findalData=[];
       // dd($md);
        $mapFunction=function ($v,&$k)use($m2,&$findalData){

            $catName=$m2->where('id',$k)->pluck('name')->first();
            $k=$catName;
            $findalData[$catName]=$v;
         //   dd($catName);
        };

        $arrayMap=array_walk($md,$mapFunction);
       return $findalData;


    }



}
