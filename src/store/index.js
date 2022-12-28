import { createStore } from 'vuex'
import createPersistedState from 'vuex-persistedstate'

export default createStore({
  state: {
    mem_no: null,
  },
  getters: {
  },
  mutations: {
    setMember(state,number){
      state.mem_no = number
    },
  },
  plugins:[createPersistedState()],
  actions: {
    setMember({commit},number){
      commit("setMember",number)
    },
  },
  modules: {
  }
})