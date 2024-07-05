import { createRouter, createWebHistory } from 'vue-router';
import IndexView from '../views/Users/IndexView.vue';
import CreateView from '../views/Users/CreateView.vue';
import EditView from '../views/Users/EditView.vue';
import UpdateProfileView from '../views/Users/UpdateProfileView.vue'
import HomeView from '../views/HomeView.vue';
import LoginView from '../views/LoginView.vue';
import RegisterView from '../views/RegisterView.vue';
import ContactView from '../views/ContactView.vue';
import NotFoundView from '../views/NotFoundView.vue'

import { useAuthStore } from '../stores/auth';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/login',
            name: 'login',
            component: LoginView
        },
        {
            path: '/register',
            name: 'register',
            component: RegisterView
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: IndexView,
        },
        {
            path: '/create',
            name: 'create',
            component: CreateView
        },
        {
            path: '/edit/:id',
            name: 'edit',
            component: EditView
        },
        {
            path: '/user-profile',
            name: 'profile',
            component: UpdateProfileView
        },
        {
            path: '/contact',
            name: 'contact',
            component: ContactView
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'NotFound',
            component: NotFoundView
        },
    ],
    linkActiveClass: 'active',
});

router.beforeEach((to, from, next) => {
    const publicPages  = ['/login', '/register'];
    const authRequired = !publicPages.includes(to.path);
    const auth         = useAuthStore();

    if (authRequired && !auth.user) next('/login')
    else if (!authRequired && auth.user) next('/')
    else next()
})

export default router;
