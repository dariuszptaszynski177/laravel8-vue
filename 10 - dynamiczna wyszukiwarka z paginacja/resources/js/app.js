require('./bootstrap');
   
window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.component('pagination', require('laravel-vue-pagination'));
  
Vue.use(VueRouter);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import ExampleComponent from './components/ExampleComponent';

Vue.component('users', require('./components/Users.vue').default);
import Users from './components/Users';

Vue.component('user', require('./components/User.vue').default);
import User from './components/User';

const routes = [
    { 
        path: '/', 
        name: 'main-page',
        component: ExampleComponent 
    },

    { 
        path: '/users', 
        name: 'users-page',
        component: Users 
    },

    { 
        path: '/user/:id', 
        name: 'user-page',
        component: User 
    },
]
  
const router = new VueRouter({
    mode: 'history', //removes # (hashtag) from url
    base: '/',
    fallback: true, //router should fallback to hash (#) mode when the browser does not support history.pushState
    routes 
})
  
const app = new Vue({
  router
}).$mount('#app')