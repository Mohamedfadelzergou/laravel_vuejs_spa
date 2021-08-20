require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import Myheader from './components/Myheader.vue'

const app = new Vue({
    el: '#app',
    components:{
        Myheader,
    }
});
