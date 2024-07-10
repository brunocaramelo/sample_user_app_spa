import {createRouter, createWebHistory} from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/login',
            component: () => import('./pages/LoginForm.vue')
        },
        {
            path: '/register',
            component: () => import('./pages/RegisterForm.vue')
        },
        {
            path: '/remember-password',
            component: () => import('./pages/RememberPassword.vue')
        },
        {
            path: '/home',
            component: () => import('./pages/HomePage.vue')
        }
    ],
})

router.beforeEach((to, from, next) => {
    if (to.path !== '/register'
        && to.path !== '/login'
        && to.path !== '/remember-password'
        && !isAuthenticated()) {
        return next({path: '/login'})
    }
    return next()
})

function isAuthenticated() {
    return Boolean(localStorage.getItem('APP_USER_TOKEN'))
}

export default router;
