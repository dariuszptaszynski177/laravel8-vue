require('./bootstrap');
   
window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';

//paginacja
Vue.component('pagination', require('laravel-vue-pagination'));

  
Vue.use(VueRouter);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// import ExampleComponent from './components/ExampleComponent';

import MainPage from './views/MainPage';
import Products from './views/products/Products';
import AddProduct from './views/products/AddProduct';
import EditProduct from './views/products/EditProduct';

import Producers from './views/producers/Producers';
import AddProducer from './views/producers/AddProducer';
import EditProducer from './views/producers/EditProducer';

const routes = [
    // {
    // path: '/admin',
    // children: [
    {
        path: '/',
        name: 'main-page',
        component: MainPage
    },

    {
        path: '/products',
        name: 'products',
        component: Products
    },

    {
        path: '/product/producer',
        name: 'product-producer',
    },

    {
        path: '/product/new',
        name: 'product-new',
        component: AddProduct
    },

    {
        path: '/product/add',
        name: 'product-add',
    },

    {
        path: '/product/edit/:id',
        name: 'product-edit',
        component: EditProduct
    },

    {
        path: '/product/delete/:id',
        name: 'product-delete',
        
    },

    {
        path: '/producers',
        name: 'producers',
        component: Producers
    },

    {
        path: '/producer/new',
        name: 'producer-new',
        component: AddProducer
    },

    {
        path: '/producer/add',
        name: 'producer-add'
    },

    {
        path: '/producer/edit/:id',
        name: 'producer-edit',
        component: EditProducer
    }
    
]

// }]

  
const router = new VueRouter({
    mode: 'history', //removes # (hashtag) from url
    base: '/',
    fallback: true, //router should fallback to hash (#) mode when the browser does not support history.pushState
    routes 
})
  
const app = new Vue({
  router
}).$mount('#app')