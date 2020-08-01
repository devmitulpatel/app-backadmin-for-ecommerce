<?php

if(!function_exists ('settings')){

    function settings($type="general"){
        $re=[];
        switch ($type){
            case 'general':
               $re =new \App\Helper\Settings(new \App\Model\Settings\General());
                break;
            case 'website':
               $re =new \App\Helper\Settings(new \App\Model\Settings\Website());
                break;
        }




        return $re;
    }
}
