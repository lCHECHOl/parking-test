/*=========================================================================================
  File Name: actions.js
  Description: Vuex Store - actions
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
import axios from "@/plugins/axios"

const actions = {

  // /////////////////////////////////////////////
  // COMPONENTS
  // /////////////////////////////////////////////



  // /////////////////////////////////////////////
  // UI
  // /////////////////////////////////////////////

  async showModalPassword(context, bool) {
    try {
      await context.commit('SHOW_MODAL_PASSWORD', bool)
    } catch (error) {
      console.log({ err: error });
    }
  },

  // /////////////////////////////////////////////
  // Auth/Login
  // /////////////////////////////////////////////

  async login(context, credentials) {
    try {
      context.commit('SET_LOADING', true, { root: true })
      await axios.get("/sanctum/csrf-cookie");
      await axios.post("/api/login", credentials);
      return context.dispatch("getUser")
    } catch (error) {
      context.commit('SET_LOADING', false, { root: true })
      return error.response
    }
  },
  // /////////////////////////////////////////////
  // Auth/Logout
  // /////////////////////////////////////////////

  async logout(context) {
    try {
      context.commit('SET_LOADING', true, { root: true })
      await axios.post("/api/logout");
      return context.dispatch("getUser")
    } catch (error) {
      console.error(error);
      context.commit('SET_LOADING', false, { root: true })
    }
  },

  // /////////////////////////////////////////////
  // Auth/Passwords
  // /////////////////////////////////////////////

  async forgotPassword(context, email) {
    try {
      context.commit('SET_LOADING_PASSWORD_MODAL', true)
      const response = await axios.post("/api/forgot-password", email);
      if (response.status == 200) {
        context.commit('SET_SUCCESS_STATUS', true)
        context.commit('SET_SUCCESS_MESSAGE', response.data.message)
        context.commit('SHOW_MODAL_PASSWORD', false)
        return true
      }
    } catch (error) {
      context.commit('SET_LOADING_PASSWORD_MODAL', false)
      return error.response
    } finally {
      context.commit('SET_LOADING_PASSWORD_MODAL', false)
    }
  },

  async resetPassword(context, credentials) {
    try {
      context.commit('SET_LOADING', true, { root: true })
      await axios.post("/api/reset-password", credentials)
      return context.dispatch("getUser")
    } catch (error) {
      console.log({ err: error });
    }
  },

  // /////////////////////////////////////////////
  // Auth/Register
  // /////////////////////////////////////////////

  async register(context, credentials) {
    try {
      context.commit('SET_LOADING', true, { root: true })
      await axios.post("/api/register", credentials);
      return context.dispatch("getUser")
    } catch (error) {
      context.commit('SET_LOADING', false, { root: true })
      return error.response
    }
  },

  // /////////////////////////////////////////////
  // Auth/User
  // /////////////////////////////////////////////

  async getUser(context) {
    try {
      const res = await axios.get("/api/user")
      context.commit("SET_USER", res.data)
      return res
    } catch (error) {
      context.commit("SET_USER", null)
      return error
    } finally {
      context.commit('SET_LOADING', false, { root: true })
    }
  }
}

export default actions
