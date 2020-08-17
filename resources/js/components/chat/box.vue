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
            <span class="main-chat-box-div-chat-div-close">x</span>


            <div class="main-chat-box-div-chat-div-section">
                <ul>
                    <li v-for="row in chatArray" >
                        <div class="main-chat-box-div-chat-div-section-user-box" :class="{
                          'main-chat-box-div-chat-div-client':  !row.from,
                          'main-chat-box-div-chat-div-admin':  row.from
                        }">
                            <div class="main-chat-box-div-chat-div-section-user" >{{row.fromName}}</div>
                            <div>{{row.data}}</div>

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
                    {
                        type:'text',
                        data:'Hello I am Bot',
                        from:1,
                        fromName:'Mitul'
                    },
                    {
                        type:'text',
                        data:'I am mitul',
                        from:0,
                        fromName:'User'
                    },
                ],
            }
        },
        methods:{
            toggleChatBox(){
                this.chatboxOpen=(this.chatboxOpen)?false:true;
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
        },
        mounted() {
            this.getIp();
        },
        watch:{
            chatArray(){
            var th =this;


                setTimeout(() => {    var div =th.$el.querySelector(".main-chat-box-div-chat-div-section");
                    div.scrollTop=div.scrollHeight; }, 5);
            }
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
        top:1px;
        left: 4px;
        margin: 2px;
        width: 70%;

        background: #eceff8;
        border: 2px solid #eceff8;
        height: 34px;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 10px;
        font-size: 14px;
        color: #737373;
    }
    .main-chat-box-div-chat-div-btn{
        position: relative;
        right: 0;
        margin: 8px;

    }

    .main-chat-box-div-chat-div-footer{
        position: absolute;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
        left: 0;
        bottom: 0;
        background: #addaf0;

    }
    .main-chat-box-div-chat-div-close{
        cursor: pointer;
        position: absolute;
        top:0;
        right: 0;
        margin: 8px;
        padding: 4px 10px;
        background-color: #885643;
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
