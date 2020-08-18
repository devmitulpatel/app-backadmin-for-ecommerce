<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header"></div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-xl-6 col-md-6 mb-4" v-for="c in cards">
                                <div class="card shadow h-100 py-2" :class="{
                                ['border-left-'+c.color]:true
                            }">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{c.title}}</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><i class="" :class="{
                                ['text-'+c.color]:true,
                                [c.iconValue]:true,
                            }"></i> #{{ cardData[c.value]}}</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fa-2x animate__animated animate__heartBeat animate__delay-5s animate__slow" :class="{
                                [c.icon]:true,
                                ['text-'+c.color]:true
                            }"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xs-12 col-xs-12 col-sm-12 col-lg-6 col-xl-6 ">
                                <div class="card">



                                    <div class="card-header">Live Users List</div>
                                    <div class="card-body">

                                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                            <thead>
                                            <tr><th rowspan="1" colspan="1">Location</th><th rowspan="1" colspan="1">IP</th><th rowspan="1" colspan="1">Browser</th></tr>
                                            </thead>

                                            <tbody>

                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12 col-xs-12 col-sm-12 col-lg-6 col-xl-6 ">
                                <div class="card">


                                    <div class="card-header">Active Chats List</div>

                                    <div class="card-body">
                                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 270px;">ID</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 270px;">Name</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 270px;">Location</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 270px;">Last Message</th>

                                               </tr>
                                        </thead>

                                        <tbody>
                                        </tbody>
                                    </table>
                                    </div>

                                </div>
                            </div>

                        </div>




                    </div>
                    <div class="card-footer">


                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "liveConnect",
        data(){
            return {

                cards:[
                    {
                        title:'Live Users',
                        color:'danger',
                        icon:'fas fa-satellite-dish',
                        iconValue:'fas fa-users',
                        value:'currentLiveUser'
                    }  ,
                    {
                        title:'Active Chats',
                        color:'primary',
                        icon:'far fa-comments',
                        iconValue:'fas fa-comment',
                        value:'currentLiveUser'
                    }
                ],

                cardData:{
                    currentLiveUser:0,
                },

                channelCount:{

                },
                echo:null,
                channel:null
            }
        },
        methods:{
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
                    authEndpoint:'/broadcasting/auth'

                });}


                //  this.bindChannels(id);

            },
            bindChannels(channel){
                var th=this;
                var channelName=channel;
                this.channel=this.echo.join(channelName);

                this.channel.listen('.userJoined',function (e) {
                        console.log(e)
                       // th.cardData.currentLiveUser=parseInt(th.cardData.currentLiveUser)+ 1;
                    })
                    .joining(function(members){
                        th.cardData.currentLiveUser=th.channel.subscription.members.count;

                        // th.cardData.currentLiveUser=th.cardData.currentLiveUser+1;
                        // th.channel.whisper('NewUserJoined',th.cardData.currentLiveUser);
                        //th.cardData.currentLiveUser=th.channel.subscription.members.count;
                    })
                    .leaving(function(members){
                       // console.log('exit');

                        if(th.cardData.currentLiveUser>0){
                            th.cardData.currentLiveUser=th.channel.subscription.members.count;
                            // th.cardData.currentLiveUser=th.cardData.currentLiveUser-1;
                            // th.channel.whisper('UserRemoved',th.cardData.currentLiveUser);
                        }

                    }).here(function(members) {
                        // for example

                        th.cardData.currentLiveUser=th.channel.subscription.members.count;


                    })
                //     .listen('pusher:ping',function(){
                //         console.log('ping');
                //         th.cardData.currentLiveUser=th.channel.subscription.members.count;
                // }).listen('pusher:pong',function(){
                //         console.log('pong');
                //         th.cardData.currentLiveUser=th.channel.subscription.members.count;
                // }).here(function(members) {
                //     // for example
                //     th.cardData.currentLiveUser=members.count;
                //
                //
                // })
                //     .bind('pusher_internal:member_added',function(){
                //     th.cardData.currentLiveUser=th.cardData.currentLiveUser+1;
                // }).bind('pusher_internal:member_removed',function(){
                //     if(th.cardData.currentLiveUser>0)th.cardData.currentLiveUser=th.cardData.currentLiveUser-1;
                // })
                //

            },
        },
        created() {
            this.connect();
            this.bindChannels('commona_user');

            var th=this;
            th.cardData.currentLiveUser=th.channel.subscription.members.count;
        },
        mounted(){
            var th=this;

            setTimeout(function(){ th.cardData.currentLiveUser=th.channel.subscription.members.count;; }, 3000);


        },
        watch:{
            isConnected(newVal){

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

</style>
