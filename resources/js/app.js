require('./bootstrap');

window.Vue = require('vue').default;
import Vue from 'vue'; // Importing Vue Library
import VueRouter from 'vue-router'; // importing Vue router library
import { VuejsDatatableFactory } from 'vuejs-datatable';

Vue.use( VuejsDatatableFactory );
Vue.use(VueRouter);
import router from './routes';

window.Vue = Vue;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add', require('./components/Add.vue').default);
Vue.component('edit', require('./components/Edit.vue').default);

Vue.component('modal', {
    template: '#modal-template'
  })

const app = new Vue({
    el: '#app',
    router
});

