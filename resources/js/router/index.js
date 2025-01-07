import {createRouter, createWebHistory} from 'vue-router';

import productIndex from '../components/products/Index.vue';

const routes = [
    {
        path:'/', 
        name:'products.index',
        component:productIndex
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router;