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
        component: Home,
        meta: {
            auth: true
        }
    },
    {
        path: '/home',
        name: 'home',
        component: Home,
        meta: {
            auth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/services',
        name: 'services',
        component: Services,
        meta: {
            auth: true
        }
    },
    {
        path: '/domains',
        name: 'domains',
        component: Domains,
        meta: {
            auth: true
        }
    },
    {
        path: '/licenses',
        name: 'licenses',
        component: Licenses,
        meta: {
            auth: true
        }
    },
    {
        path: '/reports',
        name: 'reports',
        component: Reports,
        meta: {
            auth: true
        }
    },
    {
        path: '/order',
        name: 'order',
        component: Order,
        meta: {
            auth: true
        },
        props: true
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart,
        meta: {
            auth: true
        },
        props: true
    },
];