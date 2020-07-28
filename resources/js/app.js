/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
      sideBar:false,
        shortSideBar:false,
        fullSidenar:false
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
                  overlay.style.zIndex="1";
                },

                /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
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
                 clickEventFromSideBar(url,target="main"){
                     var mian=document.getElementById("main");
                     var th =this;

                     axios.get(url).then(function(response){
                            var data =response.data;
                            main.innerHTML=data;

                     }).then(function () {
                         th.toggleSidebar();

                         if (window.history.replaceState) {
                             //prevents browser from storing history with each change:
                             var statedata={};
                             var title='changes';
                             window.history.replaceState(statedata, title, url);
                         }

                     });
                                //alert(url);




                     }

    },

    watch:{
        sideBar(NewVal,OldVal){

            (NewVal)?this.openNav():this.closeNav();

        }
    }



});




