
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// Vue.component('example', require('./components/Example.vue'));
Vue.component('type-doc', require('./components/TypeDoc.vue'));
Vue.component('table-custom', require('./components/Table.vue'));
Vue.component('create-cli-form', require('./components/clients/FormClient.vue'));

/*const app = new Vue({
    el: '#app'
});*/
import VueRouter from 'vue-router';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path:'/client/create',
            name: 'createCli',
            component: Vue.component('create-client', require('./components/clients/CreateClient.vue'))
        },
        {
            path:'/client/list',
            name: 'listCli',
            component: Vue.component('list-client', require('./components/clients/ListClient.vue'))
        },
        {
            path:'/client/:id',
            name:'editClient',
            component: Vue.component('edit-client', require('./components/clients/EditClient.vue'))
        }
    ]
});
const app = new Vue({
    el: '#app',
    router:router,
});