/*=========================================================================================
  File Name: state.js
  Description: Vuex Store - state
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/



// /////////////////////////////////////////////
// Variables
// /////////////////////////////////////////////

const userDefaults = {
  //
}

// /////////////////////////////////////////////
// State
// /////////////////////////////////////////////

const state = {
    appTitle: process.env.MIX_APP_NAME,
    sidebar: false,
    loading: false,
}

export default state
