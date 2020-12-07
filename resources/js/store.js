import Vuex from 'vuex';
import Vue from 'vue';
Vue.use(Vuex);
 
export default new Vuex.Store({
    strict: true, // strictは本番環境では必ず無効化してください
    state: {
        // commons
        isLoading: false,
        // mypage
        mp_user: {},
        mp_friends: [],
        mp_groups: [],
        mp_invites: [],
        mp_f_topics: [],
        // other
    },
    mutations: {
        startLoading (state) {
            state.isLoading = true
        },
        finishLoading (state) {
            state.isLoading = false
        },
        mypageInit (state, payload) {
            console.log(payload)
            state.mp_user     = payload.user
            state.mp_friends  = payload.friends
            state.mp_groups   = payload.groups
            state.mp_invites  = payload.invites
            state.mp_f_topics = payload.favorite_topics
            // console.log(state)
        },
        // マイページから変更された内容で上書き
        mypageUserUpdate (state, payload) {
            state.mp_user = payload.user
        }
    },
});