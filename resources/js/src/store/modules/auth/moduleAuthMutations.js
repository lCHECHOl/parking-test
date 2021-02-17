
/*=========================================================================================
File Name: mutations.js
Description: Vuex Store - mutations
----------------------------------------------------------------------------------------
Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: Pixinvent
Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


const mutations = {

  SET_USER(state, user) {
    state.user = user
    state.auth = Boolean(user)
  },

  SHOW_MODAL_PASSWORD(state, bool) {
    state.modalPassword = bool
  },

  SET_LOADING_PASSWORD_MODAL(state, payload) {
    state.modalLoading = payload
  },

  SET_SUCCESS_STATUS(state, payload) {
    state.success = payload
  },

  SET_SUCCESS_MESSAGE(state, message) {
    state.successMessage = message
  }

}

export default mutations

