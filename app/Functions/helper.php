<?php



if(!function_exists ('settings')){

    function settings($type="general"){

        //session()->flush();


        $re=[];
        switch ($type){
            case 'general':
                if(session()->has('settings.general.data')  && false){
                    $re=session()->get('settings.general.data');


                }else{




                    $model=(!\Config::has('settings.general.model'))?getModel(\App\Model\Settings\General::class):\Config::get('settings.general.model');
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
                if(session()->has('settings.website.data')  && false){
                    $re=session()->get('settings.website.data');
                }else{
                    $model=(!session()->has('settings.website.model'))?getModel(\App\Model\Settings\Website::class):session()->get('settings.website.model');
                    if(!session()->has('settings.website.model'))session()->put(['settings.website.model'=>$model]);
                    $re=(!session()->has('settings.website.data'))?new \App\Helper\Settings($model):session()->get('settings.website.data');
                    if(!session()->has('settings.website.data'))session()->put(['settings.website.data'=>$re]);

                }
                break;

            case 'product':

                if(session()->has('settings.product.data') && false){
                    $re=session()->get('settings.product.data');

                }else{


                    $model=(!session()->has('settings.product.model'))?getModel(\App\Model\Settings\Product::class):session()->get('settings.product.model');

                    if(!session()->has('settings.product.model'))session()->put(['settings.product.model'=>$model]);

                    //$re=(!session()->has('settings.product.data') || true)?new \App\Helper\Settings($model):session()->get('settings.product.data');
                    $re=new \App\Helper\Settings($model);
                    if(!session()->has('settings.product.data'))session()->put(['settings.product.data'=>$re]);

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

if(!function_exists ('getModel')){
    function getModel($str){
        $key=\Illuminate\Support\Str::slug($str);
        $masterModel=(cache()->has('masterModel'))?cache()->get('masterModel'):[];


        if(array_key_exists($key,$masterModel)){
          //  \Debugbar::info('from cache');
            return $masterModel[$key];
        }else{
        //    \Debugbar::info('from new ');
            $masterModel[$key]=new $str();
            cache()->put('masterModel',$masterModel);
            return $masterModel[$key];
        }
    }

}


