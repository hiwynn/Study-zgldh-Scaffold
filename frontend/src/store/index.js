import post from './modules/post'
import phone from './modules/phone'
import notification from './modules/notification'
import Vue from 'vue'
import Vuex from 'vuex'
import app from './modules/app'
import currentUser from './modules/currentUser'
import user from './modules/user'
import getters from './getters'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    // Append More Stores. Don't remove me
    post,
    phone,
    notification,
    app,
    currentUser,
    user
  },
  getters
})

export default store
