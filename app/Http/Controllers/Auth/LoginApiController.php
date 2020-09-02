<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use function GuzzleHttp\json_decode;

class LoginApiController extends Controller
{
    use RedirectsUsers, ThrottlesLogins;

    public $identifier=['toFind'=>['email','username'],'toVerify'=>['password']];

    public $validated=false;
    public $validationErrorMsg=[];

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if($this->validated){

      //  $http = new Client;

            $user='test@admin.ms';
            $password='123456789';

            $http = new Client;
            $response = $http->post(url('/').'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => '916e9292-2650-4130-8d0e-b6183af7f0b4',
                    'client_secret' => '84RMAfgBtBR5uophOqWY5QHfFJWt0jTFy81FzxA6',
                    'username' => $user,
                    'password' => $password,
                    'scope' => '',
                ],
            ]);

            return throwData(['JWT Token created'],json_decode($response->getBody(),true));


        }else{
            return throwError(['Please enter Valid Credentials']);
        }


    }

    public function loginProcess(Request $request)
    {
    }

    public function validateLogin(Request $r){
        $validate['hasToFind']=false;
        $validate['hasToVerify']=false;

        //dd($r->all());

        foreach ($this->identifier as $type=>$d){

            switch ($type){
                case 'toFind':
                    $setVar='hasToFind';
                    break;

                case 'toVerify':
                    $setVar='hasToVerify';
                    break;

            }
            foreach ($d as $inputName){
                if($validate[$setVar]==false &&  $r->has($inputName))$validate[$setVar][$r->has($inputName)][$inputName]=true;
            }

        }



        $er=false;
        $ermsg=[];
        foreach ($validate as $ok){

           if(array_key_exists('1',$ok) && count($ok[1])==1){

               $this->validated=true;

           }else{
                $this->validated=false;
               $er=true;

           }


        }
      //  dd($this);



    }


}
