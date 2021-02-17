import Vue from 'vue'
import axios from 'axios'

const domain = ""

Vue.prototype.$http = axios
axios.defaults.withCredentials = true

export default axios.create({
  domain
  // You can add your headers here
})
