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
                            <v-col cols="auto" @click="is_edit=!is_edit">
                                <v-btn outlined color="primary"><i class="fas fa-cog"></i></v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" v-if="is_edit">
                                <FileUp :image_name="user.image_name" @change="changeImage" />
                            </v-col>
                            <v-col cols="12" sm="3" class="text-center" v-else>
                                <IconLg :src="user.image_name" />
                            </v-col>

                            <v-col cols="12" sm="9">
                                <!--ニックネーム-->
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="ニックネーム"
                                            :disabled="!is_edit"
                                            outlined
                                            type="text"
                                            v-model="user.nickname"
                                        />
                                    </v-col>
                                </v-row>
                                <!--自己紹介欄-->
                                <v-row justify="center">
                                    <v-col v-if="is_edit || user.detail.length">
                                        <v-textarea
                                            :label="is_edit || user.detail.length ? '自己紹介欄' : null"
                                            :disabled="!is_edit"
                                            auto-grow
                                            outlined
                                            rows="1"
                                            v-model="user.detail"
                                        />
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-row class="mt-4 justify-center" v-show="is_edit">
                                <v-col cols="4">
                                    <v-btn outlined color="primary" block @click="onUserUpdate">変更</v-btn>
                                </v-col>
                            </v-row>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <!-- <MypageTabs /> -->
                <v-card>
                    <v-tabs fixed-tabs background-color="secondary" dark v-model="tab">
                        <v-tabs-slider color="accent"></v-tabs-slider>
                        <v-tab>掲示板</v-tab>
                        <v-tab>グループ</v-tab>
                        <v-tab>友達</v-tab>
                        <v-tab>トピック</v-tab>
                    </v-tabs>

                    <v-tabs-items v-model="tab">
                        <!--掲示板-->
                        <v-tab-item>
                            <!-- <Board /> -->
                            <v-card outlined>
                                <v-row>
                                    <v-col cols="12" sm="10" class="text-right">
                                        <Edit @update="onEdit" :name="'掲示板'"/>
                                    </v-col>
                                </v-row>
                                <v-row justify="center">
                                    <v-col cols="12" sm="8">
                                        <Detail :board="mp_b_detail"/>
                                    </v-col>
                                </v-row>
                                <v-row justify="center">
                                    <v-col cols="12" sm="8">
                                        <CommentList :page="page" :pageCount="pageCount" :messages="mp_b_messages"/>
                                    </v-col>
                                </v-row>
                                <v-row justify="center">
                                    <v-col cols="12" sm="8">
                                        <MessageForm @submit="onSubmit"/>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </v-tab-item>
                        <!--グループ一覧-->
                        <v-tab-item>
                            <Group />
                        </v-tab-item>
                        <!--友だち一覧-->
                        <v-tab-item>
                            <Friend />
                        </v-tab-item>
                        <!--トピック一覧-->
                        <v-tab-item>
                            <Topic />
                        </v-tab-item>
                    </v-tabs-items>
                </v-card>            </v-col>
        </v-row>
        <b-loading :isLoading.sync="isLoading" />
    </v-container>

</template>

<script>
import moment from "moment";
import UserSerch from "./UserSerch"
import Group from './tabs/Group'
import Friend from './tabs/Friend'
import Topic from './tabs/Topic'

// import MypageTabs from "./MypageTabs"
import { mapState } from 'vuex'
export default {
    data () {
        return {
            user: {
                id: null,
                name: null,
                nickname: null,
                image_id: null,
                image_name: null,
                detail: "",
            },
            tab: 0,
            is_edit: false,
            page: 1,
            pageCount: 3,            
            upload_image: null,
        }
    },
    computed: mapState([ 'isLoading', 'mp_user', 'mp_b_messages', 'mp_b_detail']),

    mounted () {
        this.getItems()
    },
    methods: {
        getItems () {
            this.$store.commit('startLoading')
            const api = axios.create()
            axios.all([
                api.get('/api/user'),
                api.get('/api/invite'),
                api.get('/api/topic/favorite'),
                api.get('/api/board/message'),
            ]).then(axios.spread((res,res2,res3,res4) => {
                // console.log(res4.data)
                this.user = res.data.user
                this.$store.commit('mypageInit', {
                    user           : res.data.user,
                    friends        : res.data.friends,
                    groups         : res.data.groups,
                    board_detail   : res.data.detail,
                    board_messages : res.data.messages,
                    invites        : res2.data,
                    favorite_topics: res3.data,
                })
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.$store.commit('finishLoading')
            })
        },
        changeImage: function (file)  {
            this.upload_image = file
        },
        onUserUpdate () {
            this.$store.commit('startLoading')
            axios.put('/api/user/', {
                id: this.user.id,
                nickname: this.user.nickname,
                upload_image: this.upload_image
            }).then(res => {
                this.$store.commit('mypageUserUpdate', {
                    user: res.data
                })
            }).catch(error => {
                alert('変更に失敗しました。')
            }).finally(resp => {
                this.$store.commit('finishLoading')
                this.is_edit = false
                this.getItems()
            })
        },
        onSubmit (message) {
            this.$store.commit('startLoading')
            axios.post('/api/board/message', {
                message  : message,
                board_id : this.mp_user.id,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onEdit(board) {
            this.$store.commit('startLoading')
            axios.post('/api/board/', {
                name   : this.board.name,
                detail : this.board.detail,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.getItems()
                this.$store.commit('finishLoading')
            })
        },
    },
    components: {
        UserSerch,
        Group,
        Friend,
        Topic,
        // MypageTabs
    }

}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>