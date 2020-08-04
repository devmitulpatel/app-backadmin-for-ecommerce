<?php


namespace App\Helper;


use Illuminate\Database\Eloquent\Model;

class Settings
{

    protected $model,$driverName;

    public $config;

    public function __construct(Model $model,$cacheName='general')
    {

//
//        if(!session()->has('settings.general.model.'.$model)){
//            session()->put('settings.general.model.'.$model,new $model());
//        }
        $strict=false;



        $this->model=$model;
        $modelexp=explode('\\',get_class($model));
        $this->driverName=strtolower(end($modelexp));
       // $this->model=new $model()   ;


        if (!$strict){
            $this->all();
        }

     //   \Debugbar::info($this);



    }


    public function all(){
        if($this->config==null)$this->allOk();
        return $this->config ;
    }

    public function get($name){
        if($this->config==null)$this->allOk();
        return (array_key_exists($name,$this->config))?$this->config[$name]:null;
    }

    private function allOk(){




       // \Cache::put('settings.'.$this->driverName.'.dataRaw', $this->model->findOrFail(1)->toArray(), 300);


       if (!\Config::has('settings.'.$this->driverName.'.dataRaw'))
       {
           \Config::set('settings.'.$this->driverName.'.dataRaw',$this->model->findOrFail(1)->toArray());
       }


       $this->config= \Config::get('settings.'.$this->driverName.'.dataRaw');


    }


}
