import Vue from 'vue';
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

export default { router };