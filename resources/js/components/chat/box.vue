<template>

    <div>


        <div class="main-chat-box-div">

            <div class="main-chat-box-div-content" v-on:click="toggleChatBox()">Chat</div>

        </div>

        <div class="main-chat-box-div-chat-div" :class="{
            'active':chatboxOpen,
            'deactive':!chatboxOpen
        }" >
            <span class="main-chat-box-div-chat-div-header">Company Name</span>
            <span class="main-chat-box-div-chat-div-close" v-on:click="closeChatbox()">x</span>


            <div class="main-chat-box-div-chat-div-section">
                <ul>
                    <li v-for="row in chatArray" >
                        <div class="main-chat-box-div-chat-div-section-user-box" :class="{
                          'main-chat-box-div-chat-div-client':  !row.from,
                          'main-chat-box-div-chat-div-admin':  row.from
                        }">
                            <div class="main-chat-box-div-chat-div-section-user" >{{row.fromName}}</div>
                            <div>{{row.data}} </div>
                            <div v-if="row.hasOwnProperty('dynamicData')">

                                <ul>
                                    <li v-for="d in row.dynamicData">
                                        <button>{{d}} </button>

                                        </li>
                                </ul>

                            </div>

                        </div>


                    </li>
                </ul>

            </div>


<div class="main-chat-box-div-chat-div-footer" v-on:keyup.enter="addUserData()" >
    <input v-model="chatInput" class="main-chat-box-div-chat-div-input"><button v-on:click="addUserData()" class="main-chat-box-div-chat-div-btn" type="submit">send</button>

</div>

        </div>

    </div>



</template>

<script>
    export default {
        name: "chatbox",
        data(){
            return{
                chatboxOpen:false,
                appId:123213,
                appSecret:'dkoqpwke',
                appToken:'test1',
                clientIp:null,
                clientData:null,
                gettingLocation: false,
                errorStr:null,
                chatInput:'',
                chatArray:[

                ],
                currentUserRaw:{

                },
                notificationsRaw:null,
                isConnectedRaw:null,
                sessionId:null,
                echo:null,
                isBinded:false,
                isPublicJoined:false

            }
        },
        methods:{
            toggleChatBox(){
                this.chatboxOpen=(this.chatboxOpen)?false:true;
            },

            closeChatbox(){
                if(this.chatboxOpen)this.chatboxOpen=false;
            },
            addMsgFromServer(data){
                if(data.hasOwnProperty('sessionId'))this.sessionId=data.sessionId;
               if(!this.isConnected) {
                 //  this.connect(data.sessionId);

               }
              if(!this.isBinded){ this.bindChannels(data.sessionId);this.isBinded=true}
             // this.chatArray.push(data)
            },
            addUserData(){

    var str=this.chatInput.trim();
if(str!="" && str!=null && str!=" " ){
    this.chatArray.push(
        {
            type:'text',
            data:str,
            from:0,
            fromName:'User'
        }
    );
    this.sendMsg(str);
    this.chatInput="";

}


            },
            getIp(){
                var url='https://api.ipify.org?format=json';
                var th=this;
                fetch(url)
                    .then(x => x.json())
                    .then(({ ip }) => {
                        th.clientIp = ip;
                        var url2="http://ip-api.com/json/"+ip;
                        fetch(url2)
                            .then(x => x.json())
                            .then((res) => {
                                th.clientData = res;
                            });
                    });
 },
            sendMsg(str){
                var domain="http://127.0.0.1:8000/";
                var url=domain+'api/v1/front/chat/send/msg/toServer';
                var th=this;
                axios.post(url,{msg:str,clientData:th.clientData,clientIp:th.clientIp}).then(res=>th.addMsgFromServer(res.data.ResponseData)).catch(e=>console.log(e));
            },
            connect(){

            var th=this;
                if(this.sessionId!=null || true){this.echo = new window.EchoRaw({
                    broadcaster: 'pusher',
                    key: process.env.MIX_PUSHER_APP_KEY,
                    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
                    wsHost:'127.0.0.1',
                    wssHost:'127.0.0.1',
                    httpHost:'127.0.0.1',
                    httpsHost:'127.0.0.1',
                    wsPort:'6001',
                    wssPort:'6001',
                    disableStats: true,
                    enabledTransports: ['ws','wss'],
                    disabledTransports: ['sockjs', 'xhr_polling', 'xhr_streaming'],
                    forceTLS: false,
                 //   authEndpoint:'/broadcasting/auth'

                });

                }


             //  this.bindChannels(id);

            },
            bindChannels(id){
                var th=this;
                var channelName="randomchat_"+id;
                this.echo.channel(channelName)
                   .listen(".incomingmsg", function(e) {

                       th.chatArray.push(e.msg)

                    })

            },
            bindPublicChannel(){

                var ec=this.echo;


                ec.join('commona_user').listen('*',(e)=>console.log(e));
            },

            disconnect(){
                if(!this.echo) return
                this.echo.disconnect()
            },

            connectPublicChannel(){
                console.log("ok1");
                this.echo.join('allComman').listen('.pusher:test',function (e) {
                console.log(e);
                console.log("ok2");
                });
            }

        },
        mounted() {


            this.getIp();
            this.connect();
            if(!this.isPublicJoined){
                this.bindPublicChannel();
                this.connectPublicChannel();
            }

        },
        watch:{
            chatArray(){
            var th =this;


                setTimeout(() => {    var div =th.$el.querySelector(".main-chat-box-div-chat-div-section");
                    div.scrollTop=div.scrollHeight; }, 5);
            },
            sessionId(newVal){
               // console.log(newVal);

            }
        },
        computed:{

            isConnected: {
                cache: false,
                get(){
                    return (this.echo &&   this.echo.connector.pusher.connection.connection !== null)
                }
            },
        }
    }
</script>

<style scoped>
    .main-chat-box-div{
        z-index: 2300;
        width: 50px;
        height: 50px;
        position: fixed;
        bottom: 1rem;
        right: 1rem;
        background-color: rgba(0,0,0,1);
        border-radius: 100%;
        box-shadow: 3px 2px 5px rgba(0,0,0,0.45);
        cursor: pointer;

    }
    .main-chat-box-div>.main-chat-box-div-content{
        display: block;
        overflow: hidden;
        color: #0f100f;
        text-align: center;
        max-width: 48px;
        max-height: 48px;
        margin: 1px;
        padding-top: 12px;
        padding-bottom: 12px;
        background-color:rgba(255,255,255,0.75); ;
        border-radius: 100%;
        box-shadow: 3px 2px 5px rgba(0,0,0,0.45);

    }
    .main-chat-box-div-chat-div{
        width: 20%;
        height: 74%;
        position: fixed;
        background-color: white;
        border: 1px solid;
        border-color: black;
        border-radius: 5px;
        z-index: 23001;
    }
    .main-chat-box-div-chat-div-input{
        position: relative;
        top:0px;
        left: 4px;

        display: flex;
        flex: 11;

        background: #eceff8;
        border: 1px solid #eceff8;
        height: 30px;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding:0px;

        font-size: 14px;
        color: #737373;
    }
    .main-chat-box-div-chat-div-btn{
        position: relative;
        right: 0;
        margin: 0px;
        display: flex;
        flex: 1;
        margin-left: 5px;
        text0akign:center;
    }

    .main-chat-box-div-chat-div-footer{
        position: absolute;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        left: 0;
        bottom: 0;
        padding: 5px;
        background: #addaf0;
        width:100%;
        display: flex;
    }
    .main-chat-box-div-chat-div-close{
        cursor: pointer;
        position: absolute;
        top: 0;
        right: 0;
        margin: 8px;
        padding: 0px 0px;
        background-color: red;
        border-radius: 100%;
        width: 37px;
        text-align: center;
        height: 37px;
        padding: 5px;
        color:white;
    }   .main-chat-box-div-chat-div-close:hover{
                transition: all 100ms ease-in;
        background-color:darkred;
                box-shadow: 1px 1px 2px rgba(0,0,0,0.75);
        font-weight: 600;
    }
    .main-chat-box-div-chat-div-header{
        margin-left: 5px;
        padding: 13px;
        position: absolute;
    }
    .active{
        box-shadow: 3px 2px 5px rgba(0,0,0,0.75);
        bottom: 78px;
        right: 1rem;

        transition: all 500ms ease-in;
    }

    .deactive{

        bottom: -10px;
        right: -40rem;

        opacity: 0;
        width: 0%;
        height: 0px;
        transition: all 500ms ease-in;
    }
    .main-chat-box-div-chat-div-section{
        margin-top: 48px;
        padding-left:10px;
        padding-right:10px;
        padding-top:5px ;

        position: absolute;
        bottom: 46px;
        width: 100%;
        top: 0%;


        overflow-y: scroll;
        border-top: 1px solid rgba(0,0,0,0.75);
        border-bottom: 1px solid rgba(0,0,0,0.75);

    }


    .main-chat-box-div-chat-div-client{
        float: left;
        display: block;
        width: 80%;
        position: relative;
        padding-left: 10px;
        text-align: left;
        background: #87CF8C;


    }
    .main-chat-box-div-chat-div-admin{
        float: right;
        display: block;
        width: 80%;
        position: relative;
        text-align: right;
        padding-right: 10px;
        background: #b3d7f5;

    }

    .main-chat-box-div-chat-div-section-user{
        font-size: 10px;
        font-weight: 800;

    }

    .main-chat-box-div-chat-div-section-user-box{
        border: 1px solid rgba(0,0,0,0.75);

        margin-bottom: 5px;
        border-radius: 10px 5px 10px 5px;

    }

    @media (max-width: 575.98px) {

        .main-chat-box-div-chat-div{
            width: 91%;
            height: 88%;
            position: fixed;
            background-color: white;
            border: 1px solid;
            border-color: black;
            border-radius: 5px;
        }

    }
    @media (min-width: 576px) and (max-width: 767.98px) {

        .main-chat-box-div-chat-div{
            width: 91%;
            height: 88%;
            position: fixed;
            background-color: white;
            border: 1px solid;
            border-color: black;
            border-radius: 5px;
        }

    }
    @media (min-width: 768px) and (max-width: 991.98px) {  }
    @media (min-width: 992px) and (max-width: 1199.98px) {  }
    @media (min-width: 1200px) {  }

</style>
