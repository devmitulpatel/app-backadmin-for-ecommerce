<?php



if(!function_exists ('settings')){

    function settings($type="general"){

        //session()->flush();


        $re=[];
        switch ($type){
            case 'general':
                if(session()->has('settings.general.data')){
                    $re=session()->get('settings.general.data');


                }else{




                    $model=(!\Config::has('settings.general.model'))?new \App\Model\Settings\General():\Config::get('settings.general.model');
                    if(!\Config::has('settings.general.model'))
                    {

                        \Config::set(['settings.general.model'=>$model]);
                        session()->put('settings.general.model',$model);
                    }
                    $re=(!\Config::has('settings.general.data'))?new \App\Helper\Settings($model):\Config::get('settings.general.data');
                    if(!\Config::has('settings.general.data')){
                        \Config::set(['settings.general.data'=>$re]);
                        session()->put('settings.general.data',$re);
                    }

                }
                break;

            case 'website':
                if(session()->has('settings.website.data')){
                    $re=session()->get('settings.website.data');
                }else{
                    $model=(!session()->has('settings.website.model'))?new \App\Model\Settings\Website():session()->get('settings.website.model');
                    if(!session()->has('settings.website.model'))session()->put(['settings.website.model'=>$model]);
                    $re=(!session()->has('settings.website.data'))?new \App\Helper\Settings($model):session()->get('settings.website.data');
                    if(!session()->has('settings.website.data'))session()->put(['settings.website.data'=>$re]);

                }
                break;
        }






        return $re;
    }
}




if(!function_exists ('throwError')){

    function throwError($msg){

        $responseData=[
            'status'=>422,
            'ResponseResult'=>false,
            'ResponseMessage'=>$msg
        ];
        return response()->json($responseData,$responseData['status']);
    }


}

if(!function_exists ('throwData')){

    function throwData($msg,$data=[]){

        $responseData=[
            'status'=>200,
            'ResponseResult'=>true,
            'ResponseMessage'=>$msg,
            'ResponseData'=>$data,
        ];
        return response()->json($responseData,$responseData['status']);
    }


}
if(!function_exists ('toJson')){

    function toJson($columns,$data=[]){
        foreach ($columns as $c) {
            if (gettype($data[$c]) == 'array') $data[$c] = json_encode($data[$c],true);

        }
        return $data;

    }


}
if(!function_exists ('toArray')){

    function toArray($columns,$data=[]){
        foreach ($columns as $c){
            if(gettype($data[$c])=='string')$data[$c]=json_decode($data[$c],true);
        }
        return $data;

    }


}


if(!function_exists ('encode')){
    function encode($str){
        return \App\Helper\Encrypter::encode($str);
    }

}

if(!function_exists ('decode')){
    function decode($str){
        return \App\Helper\Encrypter::decode($str);
    }

}
if(!function_exists ('encodeLimit')){
    function encodeLimit($str){
        return \App\Helper\Encrypter::encodeLimit($str);
    }

}
if(!function_exists ('decodeLimit')){
    function decodeLimit($str){
        return \App\Helper\Encrypter::decodeLimit($str);
    }

}
