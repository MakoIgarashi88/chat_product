import Vuex from 'vuex';
import Vue from 'vue';
Vue.use(Vuex);
 
export default new Vuex.Store({
    // strict: true, // strictは本番環境では必ず無効化してください
    state: {
        // commons
        isLoading: false,

        // home
        all_topics: [],

        // mypage friendpage 共有
        user: {},
        b_detail: {},
        b_messages: [],

        // mypage
        mp_friends: [],
        mp_groups: [],
        mp_invites: [],
        mp_f_topics: [],

        // topicpage
        topic: {},
        topic_messages: [],
        is_favorite: {},

        // chat_group
        group: {},
        members: [],
        /**
         * invites = 招待したい人たちのユーザー情報
         */
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
        // userの初期化
        userInit (state) {
            state.user = {
                nickname: '○○',
                detail: '○○',
            }
        },

        // マイページ
        mypageInit (state, payload) {
            // console.log(payload)
            state.user          = payload.user
            state.mp_friends    = payload.friends
            state.mp_groups     = payload.groups
            state.mp_invites    = payload.invites
            state.mp_f_topics   = payload.favorite_topics
            state.b_detail   = payload.board_detail
            state.b_messages = payload.board_messages
            // console.log(state)
        },
        // マイページから変更された内容で上書き
        mypageUserUpdate (state, payload) {
            const user_id = state.user.id
            state.user = payload
            // 併せてメッセージの内容も上書き
            state.b_messages.forEach(message => {
                if (message.user.id == user_id) message.user = payload
            })
        },
        groupPush (state, payload) {
            state.mp_groups.push(payload.file)
        },
        boardUpdate (state, payload) {
            state.b_detail = payload
        },
        boardMessagePush (state, payload) {
            state.b_messages.push(payload)
        },
        boardMessageRemove (state, message_id) {
            // storeから、DBから削除されたメッセージIDのmessageを削除
            state.b_messages = state.b_messages.filter(message => message.id != message_id)
        },
        joinPush (state, groups) {
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
            state.user       = payload.user
            state.b_detail      = payload.board_detail
            state.b_messages = payload.board_messages
            // console.log(state)
        },
        friendBoardMessagePush (state, payload) {
            state.b_messages.push(payload)
        },
        friendAdd (state,payload) {
            state.user       = payload.user
            state.b_detail   = payload.board_detail
            state.b_messages = payload.board_messages
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
        topicMessageRemove (state, message_id) {
            state.topic_messages = state.topic_messages.filter(message => message.id != message_id)
        },
        isFavoriteChange (state) {
            // console.log(state.is_favorite)
            state.is_favorite = !(state.is_favorite)
            // console.log(state.is_favorite)
        },
        topicUpdate (state, newTopic) {
            state.topic = newTopic
        },

        // グループチャットページ
        groupInit (state, payload) {
            state.group = payload.group
            state.members = payload.members
            state.invites = payload.invites
        },

        groupInvitePush (state, inviteds) {
            console.log(state.invites)
            console.log(inviteds)
            // filter: trueを残してfalseを削除
            // everyは配列が条件をすべて満たす場合にtrueを返す
            state.invites = state.invites.filter(value => {
                return inviteds.every(value2 => value.id != value2.id)
            })
            console.log(state.invites)
        },
    },
});