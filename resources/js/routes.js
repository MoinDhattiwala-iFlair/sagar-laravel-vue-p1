import VueRouter from 'vue-router';
import Add from './components/Add.vue';
import Edit from './components/Edit.vue';
import Index from './components/Index.vue';

let routes = [
    {
        path: '/home',
        component: Index,
        name:'Index'
    },
    {
        path: '/create',
        component: Add,
        name:'Add'
    },
    {
        path: '/edit_view/:id',
        component: Edit,
        name:'Edit'
    }
];


export default new VueRouter({
    mode :"history",
    routes
});
