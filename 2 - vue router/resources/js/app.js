require('./bootstrap');
   
window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
  
Vue.use(VueRouter);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import ExampleComponent from './components/ExampleComponent';

Vue.component('user', require('./components/User.vue').default);
import User from './components/User';

const routes = [
    { 
        path: '/', 
        name: 'main-page',
        component: ExampleComponent 
    },

    { 
        path: '/user', 
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