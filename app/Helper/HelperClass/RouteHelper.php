<?php


namespace App\Helper\HelperClass;


use App\Helper\HelperClass\Routes\RouteBox;
use Illuminate\Support\Facades\Route;

trait RouteHelper
{
    public $type,$action,$name,$url,$Final;
    public $routeRegistred=false;
    public function t($v){
        $this->type=$v;
        return $this;
    }

    public function a($v=[]){
      $this->action=implde('@',$v);
      return $this;
    }
    public function n($v){
        $this->name=$v;
        return $this;
    }
    public function u($v){
        $this->url=$v;
        return $this;
    }

    public function setType(){
        $s='';

        switch (str_split( strtolower($this->type) )[0]){
            case 'g':
                $s='get';
                break;
            case 'p':
                $s='post';
                break;
        }
        $this->Final['type']=$s;
        return $s;
    }

    public function setRoute(){
        $this->Final['route']=$this->url;
        return $this->Final['route'];
    }
    public function setAction(){
        $this->Final['action']=$this->action;
        return $this->Final['action'];
    }
   public function setName(){
        $this->Final['name']=$this->name??$this->action;
        return $this->Final['name'];
    }

    public function register(){
        $f=$this->Final;
        if(count($f)== 4 && (  array_key_exists('type',$f) && array_key_exists('action',$f)  && array_key_exists('name',$f))){

             Route::match([$f['type']],$f['route'], $f['action'])->name($f['name']);
             $this->routeRegistred=true;
             return true;
        }

        return false;

    }



}
