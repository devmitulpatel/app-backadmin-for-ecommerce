require('./bootstrap-portable');

window.Vue = require('vue');
import Vue from "vue";


Vue.component('chatbox', require('./components/chat/box').default);



const app = new Vue({
    el: '#chatid-001',
    data:{
    },
    components: {
    },
    methods:{
    },

    watch:{
    },
    mounted(){

    }



});
window.VueApp=app;
