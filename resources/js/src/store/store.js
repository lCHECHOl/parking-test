/*=========================================================================================
  File Name: store.js
  Description: Vuex store
  ----------------------------------------------------------------------------------------
  Item Name: parqueadero
  Author: Sergio Benavides
==========================================================================================*/


import Vue from 'vue'
import Vuex from 'vuex'

import state from "./state"
import getters from "./getters"
import mutations from "./mutations"
import actions from "./actions"

Vue.use(Vuex)

import moduleAuth from './modules/auth/moduleAuth'

export default new Vuex.Store({
    getters,
    mutations,
    state,
    actions,
    modules: {
      auth: moduleAuth,
    },
    strict: process.env.NODE_ENV !== 'production'
})
