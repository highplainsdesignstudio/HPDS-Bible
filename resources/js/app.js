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
Vue.component('page-component', require('./components/Bible/PageComponent.vue').default);
Vue.component('leaf-component', require('./components/Bible/LeafComponent.vue').default);

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
    data: {
        books: null,
        pageText: null,
        selectedPage: {name: null, chapter: null, chapter_id: null}
    },
    created: function() {
        fetch('api/books')
        .then(response => response.json())
        .then(data => {
            this.books = data;
        });
    },
    methods: {
        leafPage: function(_type) {
            let _newChapterId = parseInt(this.selectedPage.chapter_id) + parseInt(_type);
            if (_newChapterId < 1) {
                _newChapterId = 1189;
            } else if (_newChapterId > 1189) {
                _newChapterId = 1;
            }
            fetch('api/chapter/' + _newChapterId)
                .then(response => response.json())
                .then(data => {
                    this.selectPage(this.books[data[0].book_id - 1].book, data[0].book_id, data[0].book_chapter);
                });
        },
        selectPage: function(_book_name, _book_id, _chapter) {
            fetch('api/' + _book_id + '/' + _chapter)
            .then(response => response.json())
            .then(data => {
                this.pageText = data;
                this.selectedPage.chapter_id = this.pageText[0].chapter_id;
            });
            this.selectedPage.name = _book_name;
            this.selectedPage.chapter = _chapter;
        }
    },
    router
}).$mount('#app');
