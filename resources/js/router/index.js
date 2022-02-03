import { createRouter, createWebHistory } from 'vue-router'

import Login from '../components/auth/Login'
import Home from '../components/pages/Home'

const routes = [
    {
        name: 'login',
        path: '/login',
        component: Login,
    },
    {
        name: 'home',
        path: '/home',
        component: Home,
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
});
