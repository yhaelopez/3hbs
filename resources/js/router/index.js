import { createRouter, createWebHistory } from 'vue-router'

import Login from '../components/auth/Login'
import Home from '../components/pages/Home'
import AirportsIndex from '../components/airports/AirportsIndex';
import AirportShow from '../components/airports/AirportShow';
import AirportCreate from '../components/airports/AirportCreate';
import AirportEdit from '../components/airports/AirportEdit';

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
    {
        name: 'airports.index',
        path: '/airports',
        component: AirportsIndex,
    },
    {
        name: 'airports.create',
        path: '/airports/create',
        component: AirportCreate,
    },
    {
        name: 'airports.show',
        path: '/airports/:id',
        component: AirportShow,
        props: true
    },
    {
        name: 'airports.edit',
        path: '/airports/:id/edit',
        component: AirportEdit,
        props: true
    },
]

export default createRouter({
    history: createWebHistory(),
    routes
});
