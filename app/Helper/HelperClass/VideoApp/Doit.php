<?php

namespace Help\VideoApp;


use App\Model\VideoApp\Frame;
use App\Model\VideoApp\Image;
use App\Model\VideoApp\Ringtone;
use App\Model\VideoApp\RingtoneCat;
use App\Model\VideoApp\RingtoneCat2;
use App\Model\VideoApp\Sticker;
use foo\Foo;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\False_;
use function GuzzleHttp\json_decode;


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
                if(array_key_exists(0,$prcess) && count($prcess[0])>0){
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
                if(array_key_exists(0,$prcess) && count($prcess[0])>0){
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
                if(array_key_exists(0,$prcess) && count($prcess[0])>0){
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
                if(array_key_exists(0,$prcess) && count($prcess[0])>0){
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
                    'sortno'=>$allInput['sortno'],
                    'updated_at'=>now()
                ];
                $prcess[self::editRingtoneCat($data,$r)][]='Ringtone Category update to DB';
                if(array_key_exists(0,$prcess) && count($prcess[0])>0){
                    $er[]='Ringtone Category not Updated';
                }else {
                    $msg[]='Ringtone Category Updated';
                }

                break;


                case  5:
                    $data=[
                        'id'=>$allInput['id'],
                        'name'=>$allInput['name'],
                        'icon'=>$allInput['icon'],
                        'sortno'=>$allInput['sortno'],
                        'updated_at'=>now()
                    ];
                    $prcess[self::editRingtoneCat2($data,$r)][]='Ringtone Category update to DB';
                    if(array_key_exists(0,$prcess) && count($prcess[0])>0){
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
            'ringtonecat2'=>6,
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
                    if(array_key_exists(0,$process) && count($process[0])>0){
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
                    if(array_key_exists(0,$process) && count($process[0])>0){
                        $er[]='Image not deleted';
                    }else {
                        $msg[]='Image Deleted';
                    }

                case 3:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteSticker($data)][]='Sticker add to DB';
                    if(array_key_exists(0,$process) && count($process[0])>0){
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
                    if(array_key_exists(0,$process) && count($process[0])>0){
                        $er[]='Ringtone not deleted';
                    }else {
                        $msg[]='Ringtone Deleted';
                    }

                    break;
                case 5:
                    $data=[
                        'id'=>$id
                    ];
                    $process[self::deleteRingtoneCat($data)][]='Ringtone Category Deleted From DB';
                    if(array_key_exists(0,$process) && count($process[0])>0){
                        $er[]='Ringtone Category not deleted';
                    }else {
                        $msg[]='Ringtone Category Deleted';
                    }

                    break;

                case 6:
                        $data=[
                            'id'=>$id
                        ];
                        $process[self::deleteRingtoneCat2($data)][]='Ringtone Category 2 Deleted From DB';
                        if(array_key_exists(0,$process) && count($process[0])>0){
                            $er[]='Ringtone Category 2 not deleted';
                        }else {
                            $msg[]='Ringtone Category 2 Deleted';
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
            'ringtonecat2'=>6,
        ];
        $input=$r->all();
        $type=$input['type']??false;

        $perPager=$input['searchQuery']['per_page']??5;

        if($type!=false && array_key_exists(strtolower($type),$typeMaster)){

            switch ($typeMaster[strtolower($type)]){
                case 1:
                    $m=getModel(Frame::class);
                    break;
                case 2:

                  //  dd($input);
                    $m=getModel(Image::class);
                    break;
                case 3:
                    $m=getModel(Sticker::class);
                    break;
                case 4:
                    $m=getModel(Ringtone::class);
                    break;
                case 5:
                    $m=getModel(RingtoneCat::class);
                    break;
                case 6:
                    $m=getModel(RingtoneCat2::class);
                    break;
            }
            if(array_key_exists('searchQuery',$input) && array_key_exists('query',$input['searchQuery']) && mb_strlen($input['searchQuery']['query'])>0 &&  array_key_exists('selectedColumnToSearch',$input['searchQuery'])&& mb_strlen($input['searchQuery']['selectedColumnToSearch'])>1 ){
                $k=$input['searchQuery']['selectedColumnToSearch'];
                $v=$input['searchQuery']['query'];
                $m=$m->where($k,'like',implode('%',['',$v,'']));
            }
            return  throwData($m->paginate($perPager,['*'],'page',$input['page']??1));
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
                    'catId'=>$allInput['catId'],
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
                    'sortno'=>$allInput['sortno'],
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

                case 5:

                    $data=[
                        'name'=>$allInput['name'],
                        'icon'=>$allInput['icon'],
                        'sortno'=>$allInput['sortno'],
                        'status'=>1,
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ];
                    $prcess[self::addRingtoneCat2($data,$r)][]='Ringtone Category add to DB';
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


    
    public static function addRingtoneCat2($data,$r){

        $m=getModel(RingtoneCat2::class);
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
    public static function editRingtoneCat2($identifier,$r){

        $m = getModel(RingtoneCat2::class);
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
                        $filepaths[$f] = $r->$f->storeAs('category', $filename, $driver);
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
    public static function deleteRingtoneCat2($identifier){

        $m=getModel(RingtoneCat2::class);
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
        $md=$m->select(['name','thumbUrl','type','mp3Url','catId'])->get()->groupBy('catId')->toArray();



        $m2=getModel(RingtoneCat::class)->all();


        $sort=getModel(RingtoneCat::class)->orderBy('sortno','ASC')->pluck('name','sortno');


    //    dd($m2->where('id',));
        $findalData=[];
       // dd($md);
        $mapFunction=function ($v,&$k)use($m2,&$findalData){

            $catName=$m2->where('id',$k)->pluck('name')->first();
            $k=$catName;
            $findalData[$catName]=$v;
         //   dd($catName);
        };

        array_walk($md,$mapFunction);
//        $sortedData=[];
//        foreach ($sort as $c){
//            $sortedData[$c]=$findalData[$c];
//        }
//        foreach ($findalData as $c=>$v){
//            if(!array_key_exists($c,$sortedData)){
//                $sortedData[$c]=$v;
//            }
//        }

       return $findalData;


    }

    public static function getFileExt($url){
        $u=parse_url ($url);

        $uExplode=explode('/',$u['path']);
        $uExplode=explode('.',end($uExplode));
        return end($uExplode);
    }


    public static function importData(){
        set_time_limit(0);

        $path=app_path(implode('\\',['Helper','HelperClass','VideoApp','import.json']));
        $file=json_decode(file_get_contents($path),true);
        $importData=$file;

        $cat=$importData['Category'];
        $cm=getModel(RingtoneCat::class);
        $po=[];
        $debug=false;
        if(!$debug)foreach ($cat as $c){
          //  dd($c);
            $rowData=[];


            $code=Str::uuid();
            $fileExtetion=self::getFileExt($c['icon']);
            $filename=implode('.',[$code,$fileExtetion]);
            //dd($filename);

            $fileCat=file_get_contents($c['icon']);
            $rowData['name']=$c['name'];

            $rowData['icon']=(Storage::disk('videoapp')->put(implode('/',['category',$filename]), $fileCat))? implode('/',['category',$filename]) :"";
            $rowData['status']=1;
            $po['ringcat'][$c['name']]=$cm->insert($rowData);
        }



        $frame=$importData['ParticleNew']['Frame'];
        $fm=getModel(Frame::class);
        $sticker=$importData['ParticleNew']['Sticker'];
        $sm=getModel(Sticker::class);
        $images=$importData['ParticleNew']['Image'];
        $im=getModel(Image::class);

        $frmFile=[
            'imageUrl','thumbUrl'
        ];
        $iFile=[
            'thumbUrl'
        ];
        $sFile=[
            'thumbUrl'
        ];

        if(!$debug) foreach ($frame as $c){

            $rowData=[];
            $rowData['name']=$c['name'];
            foreach ($frmFile as $f){
                if(array_key_exists($f,$c)){
                    $code=Str::uuid();
                    $fileExtetion=self::getFileExt($c[$f]);
                    $fileCat=file_get_contents($c[$f]);
                    $filename=implode('.',[$code,$fileExtetion]);
                    $rowData[$f]=(Storage::disk('videoapp')->put(implode('/',['frames',$filename]), $fileCat))? implode('/',['frames',$filename]) :"";
                }

            }
            $rowData['status']=1;



            $po['frame'][$c['name']]=$fm->insert($rowData);
        }
        if(!$debug) foreach ($images as $c){
            $rowData=[];
           // $rowData['name']=$c['name'];
            foreach ($iFile as $f){
                if(array_key_exists($f,$c)){
                    $code=Str::uuid();
                    $fileExtetion=self::getFileExt($c[$f]);
                    $fileCat=file_get_contents($c[$f]);
                    $filename=implode('.',[$code,$fileExtetion]);
                    $rowData[$f]=(Storage::disk('videoapp')->put(implode('/',['images',$filename]), $fileCat))? implode('/',['images',$filename]) :"";
                }

            }
            $rowData['status']=1;



            $po['images'][]=$im->insert($rowData);
        }
        if(!$debug) foreach ($sticker as $c){
            $rowData=[];
            $rowData['name']=$c['name'];
            foreach ($sFile as $f){
                if(array_key_exists($f,$c)){
                    $code=Str::uuid();
                    $fileExtetion=self::getFileExt($c[$f]);
                    $fileCat=file_get_contents($c[$f]);
                    $filename=implode('.',[$code,$fileExtetion]);
                    $rowData[$f]=(Storage::disk('videoapp')->put(implode('/',['stickers',$filename]), $fileCat))? implode('/',['stickers',$filename]) :"";
                }

            }
            $rowData['status']=1;



            $po['sticker'][]=$sm->insert($rowData);
        }

        $ringtone=$importData['Ringtone'];
        $rm=getModel(Ringtone::class);

        $allCat=$cm->get();

        $rFiles=[
            'mp3Url','thumbUrl'
        ];

        if(!$debug) foreach ($ringtone as $c=>$r){
            $foundCat=$allCat->where('name',$c)->first()->toArray()['id'];

            foreach ($r as $c){
                $rowData=[];
                $rowData['name']=$c['name'];
                $rowData['catId']=$foundCat;

                foreach ($rFiles as $f){
                    if(array_key_exists($f,$c)){
                        $code=Str::uuid();
                        $fileExtetion=self::getFileExt($c[$f]);
                        $fileCat=file_get_contents($c[$f]);
                        $filename=implode('.',[$code,$fileExtetion]);
                        $rowData[$f]=(Storage::disk('videoapp')->put(implode('/',['ringtones',$filename]), $fileCat))? implode('/',['ringtones',$filename]) :"";
                    }

                }
                $rowData['type']=(array_key_exists('type',$c))?$c['type']:"";
                $rowData['status']=1;
                $po['ringtones'][$c['name']]=$rm->insert($rowData);
            }



        }

       return true;

    }




}
