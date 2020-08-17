<?php


namespace App\Helper;


use App\Model\Chat\ChatSessions;
use App\Model\Product\ProductCategory;

class Chat
{


public $dynData=[];


    public static function  inText($str){

        $c=new self();

        $text=$c->processText($str);

        session()->put('response',$text);

        $text=implode(' ',array_merge($text));
        ChatSessions::addMsgToChatSession($text,1);

        return $c->makeOut($text);



    }

    private function makeOut($text){
        return [
            "type"=>'text',
            "data"=>$text,
            "from"=>1,
            "fromName"=>'Bot',
            'dynamicData'=>$this->dynData
        ];
    }

    private function processText($str){
        $str=strtolower($str) ;
        $greetingWords=[
            'hello',
            'hi',
            'hey',
            ];

        $quetion=[
            'i',
            'want',
            'to',
            'buy'
        ];

        $OutData=[];
        $text=[];
        $explodeStr=explode(' ',$str);
        $foundKeys=[];
        foreach ($explodeStr as $k=>$s){

            $explodeStr2=str_split($s);



            if(in_array($s,$greetingWords)){$foundKeys['grettingFound'][]=$k;}else{
                $s=preg_replace("/(.)\\1+/", "$1", $s);
                if(in_array($s,$greetingWords)){$foundKeys['grettingFound'][]=$k;}
            }

            if(!array_key_exists('grettingFound',$foundKeys) &&in_array($s,$quetion)){$foundKeys['question'][]=$k;}else{
                $s=preg_replace("/(.)\\1+/", "$1", $s);
                if(in_array($s,$greetingWords)){$foundKeys['question'][]=$k;}
            }
        }

        if( array_key_exists('grettingFound',$foundKeys) &&count($foundKeys['grettingFound'])>0)$OutData['grettingFound']=true;
        if( array_key_exists('question',$foundKeys) &&count($foundKeys['question'])>1)$OutData['question']=true;



        if(array_key_exists('grettingFound',$OutData)){
            $text[]=ucfirst($greetingWords[reset($foundKeys['grettingFound'])]);
        }

        if(array_key_exists('question',$OutData)){

            $allCatM=ProductCategory::all()->where('ParentCategoryId',null)->pluck('name')->toArray();
            $this->dynData=$allCatM;
            $allCat=implode(' , ',$allCatM);



            $text[]=ucfirst('what you want ?We Have Lots of different type of products for you. Like '.$allCat);
        }

        if(count($text)<1)$text[]='Sorry we are not able to get what you are try to ask or say ?';

        return $text;



    }

}
