/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


window.Vue = require('vue');

//window.CoreUi=require('./vendor/coreui/main.js');

//require('@coreui/coreui');
import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
import CKEditor from '@ckeditor/ckeditor5-vue';

import Toasted from 'vue-toasted';

window.CKEditor=CKEditor;
Vue.use( CKEditor );
Vue.use(Toasted);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('setting-general', require('./components/settings/general').default);
Vue.component('setting-website', require('./components/settings/website').default);
Vue.component('setting-product', require('./components/settings/product').default);
Vue.component('setting-tax', require('./components/settings/tax').default);
Vue.component('product-category', require('./components/product/category').default);
Vue.component('product-subcategory', require('./components/product/subcategory').default);
Vue.component('product-addproduct', require('./components/product/addproduct').default);
Vue.component('profile', require('./components/profile').default);
Vue.component('liveconnect', require('./components/query/liveConnect').default);
Vue.component('chartforliveuser', require('./components/query/chartForlIveUser').default);


Vue.component('authclient', require('./components/passport/AuthorizedClients').default);
Vue.component('client', require('./components/passport/Clients').default);
Vue.component('accesstoken', require('./components/passport/PersonalAccessTokens').default);
Vue.component('allformforvideoapp', require('./components/VideoApp/allForms').default);
//Vue.component('alert', require('./vendor/coreui/components/alert/CAlert').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
window.validate = require("validate.js");
// const router = new VueRouter({
//     routes: Routes
// });
const app = new Vue({
    el: '#app',
    data:{
        currentUser:{},
        sideBar:false,
        shortSideBar:false,
        fullSidenar:false,
        liveComponent:null,
        winDown:false,
        darkMode:false,
        darkModeToogle:false,
        globalVar:{},
        newNotification:false,
        notificationDrawer:false,
        notificationAll:[
            {
                id:1,
                title:'Motification 1',
                description:'Motification 1',
                actions:{view:'demo',goto:'demo'},
            },
            {
                id:2,
                title:'Motification 2',
                description:'Motification 2',
                actions:{view:'demo',delete:'demo',goto:'demo'},
            }

        ],
        notificationLastActive:null,

    },
    components: {
        // Use the <ckeditor> component in this view.
       // ckeditor: CKEditor.component
    },
    methods:{



        loginFormEvent(url){
            var currentUser= this.currentUser;
            var data={
                email:currentUser.email,
                password:currentUser.password,
            };
            axios.post(url,data).then(function (r){
                var data=r.data.ResponseData;
                var msg=r.data.ResponseData[0];
                Vue.toasted.success(msg,{duration:1000});

            }).catch(function (e){



            });



        },

                autoHideNotification(){
                    var th=this;
                    // setTimeout(function() {
                    //     th.notificationDrawer=false;
                    // }, 5000);

                },

        autoHideSideBar(){
            var th=this;
            // setTimeout(function() {
            //     th.closeNav();
            // }, 5000);
        },
        registerExitNotificationDriver(){
                    var th=this;
                    setTimeout(function() {
                        th.notificationDrawer=false;
                    }, 1000);

                },

                toggleNotification(){
                  this.notificationDrawer=(this.notificationDrawer)?false:true;
                },

                setGlob(name,val){
                    this.globalVar[name]=val;
                },
                getGlob(name){
                    return (this.globalVar.hasOwnProperty(name))?this.globalVar[name]:null;
                },
                resetGlob(name){
                    this.globalVar[name]=null;
                },

              toggleDarkMode(){
               this.darkMode=(this.darkMode)?false:true;

            },
              toggleSidebar(){
                  this.sideBar=(this.sideBar)?false:true;
              },
              openNav() {
                  var width="250px";
                  var marginLeft="250px";

                  if(this.fullSidenar){
                      width="190%";
                      marginLeft="0";
                  }
                  var sidebar=document.getElementById("mySidenav");
                  var main=document.getElementById("main");
                  var overlay=document.getElementById("overlay");
                  sidebar.style.width =width;
                  main.style.marginLeft = marginLeft;
                  main.style.pointerEvents  = "none";
                  main.style.opacity="0.5";
                  overlay.style.opacity="1";
                  overlay.style.zIndex="1990";
                },
              closeNav() {

                  var width="0";
                  var marginLeft="0";

                  if(this.shortSideBar){
                       width="50px";
                       marginLeft="50px";

                  }
                  var sidebar=document.getElementById("mySidenav");
                  var main=document.getElementById("main");
                  var overlay=document.getElementById("overlay");
                    sidebar.style.width =width;
                    main.style.marginLeft = marginLeft;
                    main.style.pointerEvents  = "auto";
                    main.style.opacity="1";
                    overlay.style.opacity="0";
                    overlay.style.zIndex="-1";
                  //  document.body.style.backgroundColor = "white";
                },
              clickEventFromSideBar(url,raw=false,target="main"){
                     var mian=document.getElementById("main");
                     var th =this;

                     axios.post(url).then(function(response){
                            var data =response.data;

                            if(raw){
                                main.innerHTML=data;
                            }else
                            {


                                th.liveComponent = new Vue({
                                    name:'mslivetab',
                                    data: {
                                        message: '{}'
                                    },
                                    el: '#vuemain',
                                    template:"<div id='vuemain' >"+ data +"</div>",
                                    //     sharedState: store.state,
                                    mounted() {
                                        //    console.log(window.vueApp);
                                    },
                                    methods:{
                                        clickFromTab(data){
                                            var vApp=window.vueApp;
                                            vApp.clickFromTab(data);
                                        }
                                    }
                                });


                            }



                     }).then(function () {
                         th.sideBar=false;

                         if (window.history.replaceState) {
                             //prevents browser from storing history with each change:
                             var statedata={};
                             var title='changes';


                             let urlFinal = new URL(url);urlFinal.searchParams.delete('compact');window.history.replaceState(statedata, title, urlFinal.toString());
                         }

                     }).catch(e=>console.log(e));
                                //alert(url);




                     },
              updateScroll() {
                        this.winDown=(window.scrollY > 100)?true:false;
                    }

    },
   // router: router,
    watch:{
        sideBar(NewVal,OldVal){
            (NewVal)?this.openNav():this.closeNav();
        },

        darkMode(NewVal){
            if (NewVal){document.getElementById('mainCss').href='/css/dark.css';}else{document.getElementById('mainCss').href='/css/app.css';}
        }

    },
    mounted(){
        window.addEventListener('scroll', this.updateScroll);

    }



});
window.VueApp=app;

function popup() {
console.log('trigeres');
}
