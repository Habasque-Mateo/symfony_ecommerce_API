//import VueRouter from 'vue-router';
import {createWebHistory, createRouter} from "vue-router";
import User from '@/components/User.vue';
import Home from '@/components/Home.vue';
import Catalog from '@/components/Catalog.vue';
import Order from '@/components/Orders.vue';

const routes = [
    { path: '/',
        name: 'home',
        component: Home 
    },
    { path: '/user', component: User },
    { path: '/catalog', component:Catalog },
    { path: '/order', component:Order },
    { path: '/:notFound(.*)', component: null}    
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;