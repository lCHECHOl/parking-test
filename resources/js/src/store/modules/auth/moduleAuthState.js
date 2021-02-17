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
    user: null,
    auth: false,
    modalPassword: false,
    modalLoading: false,
    success: false,
    successMessage: '',
}

export default state
