<?php


namespace App\Helper\HelperClass\Routes;


use App\Helper\HelperClass\RouteHelper;
use phpDocumentor\Reflection\Types\False_;

class RouteBox
{
    use RouteHelper;



    public function __construct($t=false,$r=false,$a=[]){
        if($t!=false )$this->type=$t;
        if($r!=false)$this->url=$r;
        if(count($a)==2 ||count($a)==3){
            $a[0]=implode('\\',['',$a[0]]);
            switch (count($a)){
                case 2:

                    $this->action=implode('@',$a);
                    break;

                case 3:
                    $this->action=implode('@',[$a[0],$a[1]]);
                    $this->name=$a[2];
                    break;
            }


        }
        $this->setType();
        $this->setRoute();
        $this->setAction();
        $this->setName();

        $this->register();
      //  dd( $this);
        return $this;


    }

}
