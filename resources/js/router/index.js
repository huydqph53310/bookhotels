import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../pages/Home.vue')
    },
    {
        path: '/hotels',
        name: 'hotels',
        component: () => import('../pages/Hotels.vue')
    },
    {
        path: '/promotions',
        name: 'promotions',
        component: () => import('../pages/Promotions.vue')
    },
    {
        path: '/blog',
        name: 'blog',
        component: () => import('../pages/Blog.vue')
    },
    {
        path: '/contact',
        name: 'contact',
        component: () => import('../pages/Contact.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../pages/auth/Login.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('../pages/auth/Register.vue')
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Navigation guard
router.beforeEach((to, from, next) => {
    const isAuthenticated = localStorage.getItem('token');

    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login');
    } else {
        next();
    }
});

export default router;
