<?php

namespace App\Http\Controllers\VideoApp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Help\VideoApp\Doit;

class MainController extends Controller
{
    //

    public function allForms(Request $r){
        $compact=false;
        if ($r->isMethod('post')) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
        }

        $data=[
            'full'=>!$compact

        ];
        $Vuedata=[

            'path'=>[
                'retriveListData'=>route('videoapp.getData'),
                'feedDatatoDB'=>route('videoapp.feedDataToDB'),
                'frame_url'=>route('videoapp.getFile'),
                'delete'=>route('videoapp.deleteData'),
                'edit'=>route('videoapp.editDataToDB')

            ]
        ];


        return view('VideoApp.allForms')->with('data',$data)->with('Vuedata',$Vuedata);


    }

    public function getData(Request $r){
        return Doit::getData($r);
    }
    public function getFile(Request $r){
        return Doit::getFile($r);
    }
   public function deleteData(Request $r){
        return Doit::deleteData($r);
    }

    public function feedDataIntToDb(Request $r){

        return Doit::ProcessFormData($r);




    } public function editDataIntToDb(Request $r){

        return Doit::editDataIntToDb($r);




    }
}
