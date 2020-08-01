/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import CKEditor from '@ckeditor/ckeditor5-vue';
import Toasted from 'vue-toasted';

Vue.use( CKEditor );
Vue.use(Toasted)

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
Vue.component('profile', require('./components/profile').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
window.validate = require("validate.js");
const app = new Vue({
    el: '#app',
    data:{
        sideBar:false,
        shortSideBar:false,
        fullSidenar:false,
        liveComponent:null,
        winDown:false

    },
    components: {
        // Use the <ckeditor> component in this view.
       // ckeditor: CKEditor.component
    },
    methods:{
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
                             window.history.replaceState(statedata, title, url);
                         }

                     }).catch(e=>console.log(e));
                                //alert(url);




                     },
              updateScroll() {
                        this.winDown=(window.scrollY > 100)?true:false;
                    }

    },

    watch:{
        sideBar(NewVal,OldVal){
            (NewVal)?this.openNav():this.closeNav();
        },

    },
    mounted(){
        window.addEventListener('scroll', this.updateScroll);
    }



});
window.VueApp=app;
