require('./bootstrap');

window.Vue = require('vue');
Vue.component('pagination', require('laravel-vue-pagination'));
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import Myheader from './components/Myheader'
import Login from './components/Login'
import Register from './components/Register'
import Post from './components/Post'
import Swal from 'sweetalert2'
window.Swal =Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
window.Toast =Toast
const routes = [
    { path: '/login', component: Login },
    { path: '/register', component: Register },
    { path: '/Post', component: Post },
  ]
const router = new VueRouter({
    mode:'history',
    routes
  })
const app = new Vue({
    el: '#app',
    router,
    components:{
        Myheader,
        Login,
        Register,
        Post,
    }
});
