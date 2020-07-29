<?php


namespace App\Helper;


class Settings
{

    protected $model;

    public $config;

    public function __construct(\Illuminate\Database\Eloquent\Model $model)
    {
        $this->model=$model;
    }


    public function all(){
        $this->allOk();
        return $this->config ;
    }

    public function get($name){
        $this->allOk();
        return (array_key_exists($name,$this->config))?$this->config[$name]:null;
    }

    private function allOk(){
        if($this->config==null)$this->config=$this->model->findOrFail(1)->toArray();
    }


}
