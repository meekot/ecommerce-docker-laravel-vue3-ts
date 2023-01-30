import { createRouter, createWebHistory } from 'vue-router';
import { useAppStore } from '../store';

declare module 'vue-router' {
  interface RouteMeta {
    requiresAuth?: boolean;
    requiresGuest?: boolean;
  }
}

const routes = [
  {
    path: '/app',
    name: 'app',
    component: () => import('../components/AppLayout.vue'),
    meta: {
      requiresAuth: true,
    },
    children: [
      {
        path: 'dashboard',
        name: 'app.dashboard',
        component: () => import('../pages/Dashboard.vue'),
      },
      {
        path: 'products',
        name: 'app.products',
        component: () => import('../pages/Products.vue'),
      },
    ],
  },
  {
    path: '/reset-password/:token',
    name: 'resetPassword',
    component: () => import('../pages/Auth.vue'),
    props: {
      resetPasswordForm: true,
    },
    meta: {
      requiresGuest: true,
    },
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../pages/Auth.vue'),
    meta: {
      requiresGuest: true,
    },
  },
  {
    path: '/:pathMatch(.*)',
    name: 'notFound',
    component: () => import('../pages/NotFound.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const appStore = useAppStore();

  if (to.meta.requiresAuth && !appStore.isAuthenticated) {
    return next({ name: 'login' });
  }

  if (to.meta.requiresGuest && appStore.isAuthenticated) {
    return next({ name: 'app.dashboard' });
  }

  next();
});

export { router };
