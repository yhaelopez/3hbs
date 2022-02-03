import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from './components/Home.vue';
import AirlineIndex from './components/airlines/Index.vue';
import AirlineCreate from './components/airlines/Create.vue';
import AirlineEdit from './components/airlines/Edit.vue';
import AirlineShow from './components/airlines/Show.vue';
import AirportIndex from './components/airports/Index.vue';
import AirportCreate from './components/airports/Create.vue';
import AirportEdit from './components/airports/Edit.vue';
import AirportShow from './components/airports/Show.vue';
import FlightIndex from './components/flights/Index.vue';
import FlightCreate from './components/flights/Create.vue';
import FlightEdit from './components/flights/Edit.vue';
import FlightShow from './components/flights/Show.vue';

Vue.use(VueRouter)

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
    },
    {
        name: 'airline',
        path: '/airline',
        component: AirlineIndex,
    },
    {
        name: 'airlineCreate',
        path: '/airline/create',
        component: AirlineCreate,
    },
    {
        name: 'airlineShow',
        path: '/airline/:id',
        component: AirlineShow,
    },
    {
        name: 'airlineEdit',
        path: '/airline/:id/edit',
        component: AirlineEdit,
    },
    {
        name: 'airport',
        path: '/airport',
        component: AirportIndex,
    },
    {
        name: 'airportCreate',
        path: '/airport/create',
        component: AirportCreate,
    },
    {
        name: 'airportShow',
        path: '/airport/:id',
        component: AirportShow,
    },
    {
        name: 'airportEdit',
        path: '/airport/:id/edit',
        component: AirportEdit,
    },
    {
        name: 'flight',
        path: '/flight',
        component: FlightIndex,
    },
    {
        name: 'flightCreate',
        path: '/flight/create',
        component: FlightCreate,
    },
    {
        name: 'flightShow',
        path: '/flight/:id',
        component: FlightShow,
    },
    {
        name: 'flightEdit',
        path: '/flight/:id/edit',
        component: FlightEdit,
    },
]

export default routes
