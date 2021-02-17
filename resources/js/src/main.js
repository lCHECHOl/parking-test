/*=========================================================================================
  File Name: main.js
  Description: main vue(js) file
  ----------------------------------------------------------------------------------------
  Item Name: parqueadero
  Author: Sergio Benavides
==========================================================================================*/

import Vue from 'vue'
import App from './App.vue'

// Vuetify Framework and Theme Configurations
import vuetify from '@/plugins/vuetify'

// Globally Registered Components
import './globalComponents'

// Vue Router
import router from './router'

// Vuex
import store from './store/store'
store.dispatch('auth/getUser')

// Plugins
require('./plugins/index')

Vue.config.productionTip = false

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App)
}).$mount('#app')