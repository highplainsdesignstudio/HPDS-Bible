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

// Register global components.
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('index-component', require('./components/Bible/IndexComponent.vue').default);
// Vue.component('page-component', require('./components/Bible/PageComponent.vue').default);
// Vue.component('leaf-component', require('./components/Bible/LeafComponent.vue').default);
// Vue.component('login-component', require('./components/Form/LoginComponent.vue').default);

// Import local components.
import IndexComponent from './components/Bible/IndexComponent.vue';
import PageComponent from './components/Bible/PageComponent.vue';
import SavedHighlightsComponent from './components/Bible/SavedHighlightsComponent.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue Router Routes
// import VueRouter from 'vue-router';
// import ExampleComponent from './components/ExampleComponent.vue';
// import Axios from 'axios';
// Vue.use(VueRouter);

// const routes = [
//     // { path: '/vue', component: Home, name: 'Home' },
//     { path: '/read/example', component: ExampleComponent, name: 'ExampleComponent' }
// ];

// const router = new VueRouter({
//     routes // short for `routes: routes`
//   });
// import router from './routes.js';
// End Vue Router Routes.

const app = new Vue({
    el: '#app',
    components: {
        'index-component': IndexComponent,
        'page-component': PageComponent,
        'saved-highlights-component': SavedHighlightsComponent
    },
    data: {
        books: null,
        pageText: null,
        selectedPage: {name: null, chapter: null, chapter_id: null}
    },
    created: function() {
        fetch('/api/books')
        .then(response => response.json())
        .then(data => {
            this.books = data;
        });  
    },
    methods: {
        // getCookie: function(cname) {
        //     let name = cname + "=";
        //     let decodedCookie = decodeURIComponent(document.cookie);
        //     let ca = decodedCookie.split(';');
        //     for(let i = 0; i <ca.length; i++) {
        //         let c = ca[i];
        //         while (c.charAt(0) == ' ') {
        //             c = c.substring(1);
        //         }
        //         if (c.indexOf(name) == 0) {
        //             return c.substring(name.length, c.length);
        //         }
        //     }
        //     return "";
        // },
        // setCookie: function(cname, cvalue, exdays) {
        //     var d = new Date();
        //     d.setTime(d.getTime() + (exdays*24*60*60*1000));
        //     var expires = "expires="+ d.toUTCString();
        //     document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        //   },
    },
    // router
});
// .$mount('#app');