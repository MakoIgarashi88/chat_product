<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card outlined>
                    <v-card-title>
                        <v-row class="justify-space-between">
                            <v-col cols="auto">
                                {{user.name}}のページ
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col class="text-right">
                                <div v-if="user.is_friend"><GoChatButton :id="user.id" @goChat="onRoot"/></div>
                                <v-btn color="primary" v-else>友だち追加</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row align="center">
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" class="text-center">
                                <IconLg :src="user.image_name" />
                            </v-col>

                            <v-col cols="12" sm="9">
                                <!--ニックネーム-->
                                <v-row align="center">
                                    <v-col>
                                        <v-text-field
                                            :label="user.nickname"
                                            disabled
                                            outlined
                                        />
                                    </v-col>
                                </v-row>
                                <!--自己紹介欄-->
                                <!-- <v-row justify="center">
                                    <v-col v-if="user.detail.">
                                        <v-textarea
                                            :label="user.detail.length ? user.detail : null"
                                            disabled
                                            auto-grow
                                            outlined
                                            rows="1"
                                        />
                                    </v-col>
                                </v-row> -->
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
                <v-card class="mt-4" outlined>
                    <v-row>
                        <v-col>
                            <v-card-text>
                                <Detail :board="board"/>
                            </v-card-text>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <v-card-text>
                                <CommentList :messages="messages"/>
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
            user: {
                id: null,
                name: null,
                nickname: null,
                detail: "",
                image_id: null,
                image_name: null,
                is_friend: false,
            },
            board: [],
            messages: [],
        }
    },
    computed: mapState([ 'isLoading' ]),
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
                this.user = res.data.user
                this.board = res.data.detail
                this.messages = res.data.messages
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
                board_id : this.user.id,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onRoot (friend_id) {
            this.$router.push({ name: 'chat.private', params: {'friend_id': friend_id} }) 
        }
        // onFriendApply() {
        //     if(confirm('友達申請をします')) {
        //         axios.post('/api/friend/add/', {
        //             friend_id: this.user_id,
        //         }).then(res => {
        //             if (res.data.message.length) {
        //                 alert(res.data.message)
        //             } else {
        //                 alert('友だちになりました。')
        //                 this.getItems()
        //             }
        //         }).catch(error => {
        //             alert('友だちの追加に失敗しました。')
        //         })
        //     }
        // },
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