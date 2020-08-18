<?php

namespace App\Http\Controllers\Query;

use App\Events\Chat\AllUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleLiveClients extends Controller
{

    public function index(Request $r){
        $compact=false;
        if ($r->isMethod('post')) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
        }



        $data=[
            'full'=>!$compact

        ];

       // broadcast(new AllUser('userJoined',[]));


        $Vuedata=[
            'path'=>[

                'save.cat'=>route('product.category.save'),
                'delete.cat'=>route('product.category.delete'),
                'edit.cat'=>route('product.category.edit'),


                'delete.extraFields'=>route('settings.Product.Extra.delete'),

                'edit.extraFields'=>route('settings.Product.Extra.edit'),
                'get.allUnits'=>route('settings.Product.Units.all'),

                'get.allExtra'=>route('settings.Product.Extra.all'),
                'get.allCat'=>route('settings.Product.Category.all'),
                'get.allSCat'=>route('settings.Product.SubCategory.all'),
                'upload.img'=>route('product.img.upload'),

                'save.product'=>route('product.save')




            ],

            'img'=>[

            ],
            //  'inputData'=>settings('product')->all(),

        ];



        return view('query.liveconnect')->with('data',$data)->with('Vuedata',$Vuedata);
    }

}
