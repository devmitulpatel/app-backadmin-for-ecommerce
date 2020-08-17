<?php

namespace App\Model\Chat;

use App\Helper\HelperClass\ModelHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ChatSessions extends Model
{
    //

    use ModelHelper;

    public static function makeChatSession($data,$msg){

        $m=getModel(__CLASS__);
        $data=[
            'country'=>$data['country'],
            'countryCode'=>$data['countryCode'],
            'region'=>$data['region'],
            'city'=>$data['city'],
            'zip'=>$data['zip'],
            'lat'=>$data['lat'],
            'lon'=>$data['lon'],
            'timezone'=>$data['timezone'],
            'isp'=>$data['isp'],
            'org'=>$data['org'],
            'ip'=>$data['query'],
        ];
     //   \Debugbar::info($data);
        $data2=[];
        if($m->where('ip',$data['ip'])->get()->count()< 1){$data2=$m->_()->_add($data)->_gd();}else{
            $data2=$m->where('ip',$data['ip'])->get()->first()->toArray();
        }
        //\Debugbar::info($data2);
        if(!session()->has('current_chat_session'))session()->put('current_chat_session',$data2['id']);
        $tableName=implode('_',['chat_sessions',$data2['id']]);
        if(!Schema::hasTable($tableName)) { $m->makeChatTable($data2['id'],$msg);}else{
            self::addMsgToChatSession($msg);
        }
    }

    private function makeChatTable($id,$msg){

        $tableName=implode('_',['chat_sessions',$id]);

       if(!Schema::hasTable($tableName)) Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('data');
            $table->string('from');
            $table->string('fromName');
            $table->timestamps();
        });

        DB::table($tableName)->insert([
            'type'=>'text',
            'data'=>$msg,
            'from'=>'0',
            'fromName'=>'user',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
     }

     public static function addMsgToChatSession($msg,$type=0){

        $id=session('current_chat_session');
         $tableName=implode('_',['chat_sessions',$id]);

         DB::table($tableName)->insert([
             'type'=>'text',
             'data'=>$msg,
             'from'=>$type,
             'fromName'=>($type)?'bot':'user',
             'created_at'=>now(),
             'updated_at'=>now(),
         ]);



     }


}
