<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card outlined>
                    <v-card-title>
                        <v-row class="justify-space-between">
                            <v-col cols="auto">
                                {{fp_user.name}}のページ
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col class="text-right">
                                <div v-if="fp_user.is_friend"><GoChatButton :id="fp_user.id" @goChat="onRoot"/></div>
                                <v-btn color="primary" @click="addFriend" v-else>友だち追加</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row align="center">
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" class="text-center">
                                <IconLg :src="fp_user.image_name" />
                            </v-col>

                            <v-col cols="12" sm="9">
                                <!--ニックネーム-->
                                <v-row align="center">
                                    <v-col>
                                        <v-text-field
                                            :label="fp_user.nickname"
                                            disabled
                                            outlined
                                        />
                                    </v-col>
                                </v-row>
                                <!--自己紹介欄-->
                                <v-row justify="center">
                                    <v-col v-if="fp_user.detail.length">
                                        <v-textarea
                                            :label="fp_user.detail.length ? fp_user.detail : null"
                                            disabled
                                            auto-grow
                                            outlined
                                            rows="1"
                                        />
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
                <v-card class="mt-4" outlined>
                    <v-row>
                        <v-col>
                            <v-card-text>
                                <Detail :board="fp_b_detail"/>
                            </v-card-text>
                        </v-col>
                    </v-row>
                    <v-row v-show="fp_b_messages.length">
                        <v-col>
                            <v-card-text>
                                <CommentList :messages="fp_b_messages" :pageSize="pageSize"/>
                            </v-card-text>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-card-text>
                                <MessageForm @submit="onSubmit"/>
                            </v-card-text>
                        </v-col>
                    </v-row>
                    <!-- <Board /> -->
                </v-card>
            </v-col>
        </v-row>
        <b-loading :isLoading.sync="isLoading" />
    </v-container>
</template>

<script>
import PrivateChat from '../chat/private/Private.vue'
// import Board from './tabs/Board.vue'
import moment from "moment";
import { mapState } from 'vuex'
export default {
    props: ['user_id'],
    data () {
        return {
            pageSize: 5,
        }
    },
    computed: mapState([ 'isLoading', 'fp_user', 'fp_b_detail', 'fp_b_messages' ]),
    mounted () {
        this.getItems()
    },
    methods: {
            getItems () {
            this.$store.commit('startLoading')
            const api = axios.create()
            axios.all([
            api.get('/api/friend/' + this.user_id),
            ]).then(axios.spread((res,res2) => {
                this.$store.commit('friendpageInit', {
                    user          : res.data.user,
                    board_detail  : res.data.detail,
                    board_messages: res.data.messages,
                })
                // console.log(res.data.user)
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.$store.commit('finishLoading')
            })
        },
        onSubmit (message) {
            this.$store.commit('startLoading')
            axios.post('/api/board/message', {
                message  : message,
                board_id : this.user_id,
            }).then(res => {
                this.$store.commit('friendBoardMessagePush', res.data)
            })
            .catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onRoot (friend_id) {
            this.$router.push({ name: 'chat.private', params: {'friend_id': friend_id} }) 
        },
        addFriend () {
            if(confirm('友達申請をしますか？')) {
                axios.post('/api/friend/add/', {
                    friend_id: this.user_id,
                }).then(res => {
                    if (res.data.message.length) {
                        alert(res.data.message)
                    } else {
                        alert('友だちに追加しました。')
                        this.getItems()
                        // this.$store.commit('friendAdd')
                    }
                }).catch(error => {
                    alert('友だち追加に失敗しました')
                })
            }
        },
        // onMessage: function () {
        //     this.$router.push({ name: 'chat.private', params: { 'user_id': this.user.id} })
        // },
    },
    components:{
        PrivateChat,
        // Board,
    }
}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>