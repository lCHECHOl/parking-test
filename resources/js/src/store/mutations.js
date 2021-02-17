/*=========================================================================================
  File Name: mutations.js
  Description: Vuex Store - mutations
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


const mutations = {


  // /////////////////////////////////////////////
  // COMPONENTS
  // /////////////////////////////////////////////

  // Vertical NavMenu

    CHANGE_SIDEBAR_STATUS(state, sidebarStatus) {
      state.sidebar = sidebarStatus
    },

  // Navbar-Vertical

  // ////////////////////////////////////////////
  // UI
  // ////////////////////////////////////////////

  SET_LOADING (state, bool) {
    state.loading = bool
  }

}

export default mutations

