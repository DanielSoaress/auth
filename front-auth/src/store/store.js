import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        baseApiUrl: "http://127.0.0.1:8000/",
        user: {
            user: "",
            token: "",
        },
    },
    getters: {
        getUser(state){
            return state.user.user
        },
        getToken(state){
            return state.user.token
        },
        getBaseUrl(state){
            return state.baseApiUrl
        }
    },
    mutations: {
        setToken(state, payload){
            state.user.token = payload;
        }
    },
    actions: {
        setToken(context, payload){
            context.commit('setToken', payload);
        }
    }
})