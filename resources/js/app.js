require('./bootstrap');

window.Vue = require('vue');
import Myheader from './components/Myheader.vue'

const app = new Vue({
    el: '#app',
    components:{
        Myheader,
    }
});
