<?php

namespace Help\VideoApp;


use App\Model\VideoApp\Frame;
use App\Model\VideoApp\Image;
use App\Model\VideoApp\Ringtone;
use App\Model\VideoApp\RingtoneCat;
use App\Model\VideoApp\Sticker;

class Doit
{

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

    public static function addFrame($data){}
    public static function editFrame($identifier,$data){}
    public static function deleteFrame($identifier){}

    public static function addImage($data){}
    public static function editImage($identifier,$data){}
    public static function deleteImage($identifier){}

    public static function addSticker($data){}
    public static function editSticker($identifier,$data){}
    public static function deleteSticker($identifier){}

    public static function addRingtone($data){}
    public static function editRingtone($identifier,$data){}
    public static function deleteRingtone($identifier){}

    public static function addRingtoneCat($data){}
    public static function editRingtoneCat($identifier,$data){}
    public static function deleteRingtoneCat($identifier){}



}
