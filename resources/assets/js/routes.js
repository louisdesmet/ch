import Login from './components/Login';
import Home from './components/Home';
import Services from './components/Services';
import Domains from './components/Domains';
import Licenses from './components/Licenses';
import Reports from './components/Reports';
import Order from './components/Order';
import Cart from './components/Cart';

export const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/home',
        name: 'home',
        component: Home
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/services',
        name: 'services',
        component: Services
    },
    {
        path: '/domains',
        name: 'domains',
        component: Domains
    },
    {
        path: '/licenses',
        name: 'licenses',
        component: Licenses
    },
    {
        path: '/reports',
        name: 'reports',
        component: Reports
    },
    {
        path: '/order',
        name: 'order',
        component: Order,
        props: true
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart,
        props: true
    },
];