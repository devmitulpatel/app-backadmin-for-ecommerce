<?php

namespace App\Http\Controllers\Chat;

use App\Events\Chat\SendMsg;
use App\Helper\Chat;
use App\Http\Controllers\Controller;
use App\Model\Chat\ChatSessions;
use Illuminate\Http\Request;
use App\Helper\T\ChatHelper;
class HandleMsg extends Controller
{
    use ChatHelper;
    public function hasMsg(Request $r){



        \Debugbar::info($r->all());

        ChatSessions::makeChatSession($r->get('clientData'),$r->get('msg'));


        return $this->tD(['Data is Geting From Client'],
            Chat::inText($r->get('msg'))
            );

    }


}
