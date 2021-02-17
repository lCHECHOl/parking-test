/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
	Item Name: parqueadero
	Author: Sergio Benavides
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  // base: process.env.MIX_BASE_URL,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes: [

    {
      // =============================================================================
      // MAIN LAYOUT ROUTES
      // =============================================================================
      path: '',
      component: () => import('./layouts/main/Main'),
      children: [
        // =============================================================================
        // Public Routes
        // =============================================================================
        {
          path: '/',
          name: 'home',
          component: () => import('./views/Home.vue')
        },
      ],
    },
    // =============================================================================
    // FULL PAGE LAYOUTS
    // =============================================================================
    {
      path: '',
      component: () => import('@/layouts/full-page/FullPage.vue'),
      children: [
        // =============================================================================
        // PAGES
        // =============================================================================
        {
          path: '/login',
          name: 'page-login',
          component: () => import('@/views/pages/Login.vue')
        },
        {
          path: '/registro',
          name: 'page-registro',
          component: () => import('@/views/pages/Register.vue')
        },
        {
          path: '/forgot-password*',
          name: 'recovery-password',
          component: () => import('@/views/pages/RecoveryPassword.vue')
        },
        // {
        //   path: '/pages/error-404',
        //   name: 'page-error-404',
        //   component: () => import('@/views/pages/Error404.vue')
        // },
      ]
    },
    // // Redirect to 404 page, if no match found
    // {
    //     path: '*',
    //     redirect: '/pages/error-404'
    // }
  ],
})

// router.afterEach(() => {
//   // Remove initial loading
//   const appLoading = document.getElementById('loading-bg')
//     if (appLoading) {
//         appLoading.style.display = "none";
//     }
// })

export default router

