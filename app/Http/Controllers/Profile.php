<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Profile extends Controller
{
    public function index(Request $r){
        $compact=false;
        if ($r->isMethod('post') || true) {
            $compact=($r->has('compact') && $r->get('compact'))?true:false;
            $alert=($r->has('alert') && $r->get('alert'))?true:false;
        }


        $data=[
            'full'=>!$compact,
            'alert'=>(isset($alert))? $alert : []
        ];


            return view('profile')->with('data',$data);

    }

    public function save(\App\Http\Requests\Profile $r){


        $input=$r->all();
        if(array_key_exists('password',$input)){

            unset($input['password_confirmation']);
            $input['password']=\Hash::make($input['password']);

        }

        unset($input['created_at']);
        $input['updated_at']=now();
        $response=[];

        $m=new \App\User();

        try {

            $m->updateOrInsert(['id'=>1],$input);
            $response=[
                'status'=>200,
                'action'=>true,
                'msg'=>"Profile Updated",
                'nextUrl'=>route('profile',['compact'=>true,'alert'=>true])

            ];

        }catch (\Exception $e){
            $response=[
                'status'=>422,
                'action'=>false,
                'msg'=>"Profile Not Updated",
                'msgDebug'=>$e->getMessage()

            ];


        }
        return response()->json($response,$response['status']);

    }
}
