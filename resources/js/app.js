/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// require('./routes');

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
Vue.component('index-component', require('./components/Bible/IndexComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue Router Routes
import VueRouter from 'vue-router';
import ExampleComponent from './components/ExampleComponent.vue';
Vue.use(VueRouter);

const routes = [
    // { path: '/vue', component: Home, name: 'Home' },
    { path: '/read/example', component: ExampleComponent, name: 'ExampleComponent' }
];

const router = new VueRouter({
    routes // short for `routes: routes`
  });
// import router from './routes.js';
// End Vue Router Routes.

const app = new Vue({
    el: '#app',
    router
}).$mount('#app');
