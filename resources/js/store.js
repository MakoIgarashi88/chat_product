import Vuex from 'vuex';
import Vue from 'vue';
Vue.use(Vuex);
 
export default new Vuex.Store({
    strict: true, // strictは本番環境では必ず無効化してください
    state: {
        // commons
        isLoading: false,

        // home
        all_topics: [],

        // mypage
        mp_user: {detail: "",},
        mp_friends: [],
        mp_groups: [],
        mp_invites: [],
        mp_f_topics: [],
        mp_b_detail: {},
        mp_b_messages: [],

        // friendpage
        fp_user: {detail: "",},
        fp_b_detail: {},
        fp_b_messages: [],

        // topicpage
        topic: {},
        topic_messages: [],
        is_favorite: {},

        // chat_group
        group: {},
        members: [],
        invites: [],
        upload_group: [],
    },
    mutations: {
        startLoading (state) {
            state.isLoading = true
        },
        finishLoading (state) {
            state.isLoading = false
        },
        homeInit (state,payload) {
            state.all_topics = payload
        },

        // マイページ
        mypageInit (state, payload) {
            // console.log(payload)
            state.mp_user       = payload.user
            state.mp_friends    = payload.friends
            state.mp_groups     = payload.groups
            state.mp_invites    = payload.invites
            state.mp_f_topics   = payload.favorite_topics
            state.mp_b_detail   = payload.board_detail
            state.mp_b_messages = payload.board_messages
            // console.log(state)
        },
        // マイページから変更された内容で上書き
        mypageUserUpdate (state, payload) {
            state.mp_user = payload
        },
        boardUpdate (state, payload) {
            state.mp_b_detail = payload
        },
        boardMessagePush (state, payload) {
            state.mp_b_messages.push(payload)
        },
        invitePush (state, groups) {
            groups.forEach(group => {
                state.mp_groups.push(group)
            })
        },
        inviteDelete (state, delete_invite_ids) {
            state.mp_invites = state.mp_invites.filter(invite => {
                // someは配列が条件を一つでも満たしていればtrueを返す
                // everyは配列が条件をすべて満たす場合にtrueを返す
                return delete_invite_ids.every(invite_ids => invite_ids !== invite.id)
                // return true  削除しない (inviteのidがdelete_invite_idsに含まれない)
                // return false 削除する   (inviteのidがdelete_invite_idsに含まれる)
            })
        },

        // フレンドページ
        friendpageInit (state, payload) {
            // console.log(payload)
            state.fp_user       = payload.user
            state.fp_b_detail   = payload.board_detail
            state.fp_b_messages = payload.board_messages
            // console.log(state)
        },
        friendBoardMessagePush (state, payload) {
            state.fp_b_messages.push(payload)
        },
        friendAdd (state) {
            state.fp_user       = payload.user
            state.fp_b_detail   = payload.board_detail
            state.fp_b_messages = payload.board_messages
        },

        // トピックページ
        topicInit (state, payload) {
            state.topic = payload.topic
            state.topic_messages = payload.messages
            state.is_favorite = payload.is_favorite
        },
        topicMessagePush (state, payload) {
            state.topic_messages.push(payload)
        },
        isFavoriteChange (state) {
            console.log(state.is_favorite)
            state.is_favorite = !(state.is_favorite)
            console.log(state.is_favorite)
        },

        // グループチャットページ
        groupInit (state, payload) {
            state.group = payload.group
            state.members = payload.members
            state.invites = payload.invites
        },

    },
});