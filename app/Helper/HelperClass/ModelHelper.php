<?php


namespace App\Helper\HelperClass;


use App\Model\Settings\General;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Mixed_;

trait ModelHelper
{

    public static function _(){
       $m=__CLASS__;
       $newObject=new Class{

           use ModelHelper;
           protected $modelRaw,$data,$where,$response;

           public function __construct($model=0)
           {


               $this->modelRaw=$model;
           }

       };


       $newObject=new $newObject($m);

       return $newObject;
    }

    public function _q(){
        return $this->modelRaw;
    }

    public function _update($where=[],$data=[]){

        $m=$this->_q()::find($where)->first();
        $this->data=$data;
        $this->where=$where;
        if($m==null){
            $this->makeResponse(false,2);
            return $this;
        }
        $s=$m->setRawAttributes($data)->save();
      //  $this->_sd('id',$m->id);
        $this->makeResponse($s,2);

        return $this;
    }
    public function _add($data=[], $mapFunction=null){
        $mc=$this->_q();
        $this->data=$data;
        $m=new $mc;
        $m->fillable=array_keys($data);
        if($mapFunction!=null)array_map($mapFunction,$data);
        $m->setRawAttributes($data);

        $s=$m->save();
        $this->_sd('id',$m->id);
        $this->makeResponse($s,1);

        return $this;

    }
    public function _delete($where=[]){
        $this->where=$where;
        $m=$this->_q()::find($where)->first();
        $s=($m!=null)?$m->delete():false;

        $this->makeResponse($s,3);

        return $this;

    }

    public function makeResponse(bool $process,string $type){
        $fType=null;
//        $dbentr=[
//            'type'=>$fType
//            'table'=>
//            'connection'
//            'model'
//            'prefix'
//            'callByFunction'
//            'takenById'
//            'count'
//            'whereData'
//            'data'
//        ];
        $data=[];
        switch ($type){
            case '1':
                $fType='add';
                break;
            case '2':
                $fType='update';
                break;
            case '3':
                $fType='delete';
                break;
        }

        if($fType!=null && $process){
            $data=[
                'status'=>$process,
                'actionType'=>$fType,
        ];
            if(env('APP_DEBUG',false)){

                $data['data']=$this->_gd();
                $data['where']=$this->_gw();
            }



        }else{
            $data=[
                'status'=>$process,
                'actionType'=>$fType,
                'waring'=>'Databse Function run but not after that'
            ];
        }


        $this->response=$data;


    }
    public function _2J():string {
        return collect($this->_gr())->toJson();
    }

    public function _2A():array {
        return $this->_gr();
    }

    public function _sd($k,$v){
        $this->data[$k]=$v;
    }
    public function _gd():array {
        return $this->data?? [];
    }

    public function _sw(array $w){
        $this->where=$w;
    }
    public function _gw():array {
       return $this->where??[];
    }

    public function _sr(array $r){
        $this->response=$r;
    }
    public function _gr():array {
       return $this->response??[];
    }



}
