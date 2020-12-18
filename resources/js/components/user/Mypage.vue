<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card outlined>
                    <v-card-title>
                        <v-row class="justify-space-between">
                            <v-col cols="auto">
                                {{mp_user.name}}のページ
                                <!-- {{mp_b_messages}} -->
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col cols="auto">
                                <v-btn outlined color="primary" @click="is_edit=!is_edit"><i class="fas fa-cog"></i></v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" v-if="!is_edit">
                                <IconLg :src="mp_user.image_name" />
                            </v-col>
                            <v-col cols="12" sm="3" class="text-center" v-else>
                                <FileUp :image_name="mp_user.image_name" @change="changeImage" />
                            </v-col>

                            <v-col cols="12" sm="9">
                                <!--ニックネーム-->
                                <v-row>
                                    <v-col>
                                        <v-text-field label="ニックネーム" disabled outlined type="text" v-model="mp_user.nickname" v-if="!is_edit"/>
                                        <v-text-field label="ニックネーム" outlined type="text" v-model="nickname" v-else/>
                                    </v-col>
                                </v-row>
                                <!--自己紹介欄-->
                                <v-row justify="center">
                                    <v-col>
                                        <v-textarea label='自己紹介欄' auto-grow outlined rows="1" v-model="mp_user.detail" disabled v-if="!is_edit && mp_user.detail.length"/>
                                        <v-textarea label='自己紹介欄' auto-grow outlined rows="1" v-model="detail" v-else-if="is_edit"/>
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

        <v-row v-show="mp_invites.length">
            <v-col>
                <v-card outlined>
                    <v-card-title>
                        招待されているグループ
                    </v-card-title>
                    <v-card-text>
                        <v-list>
                            <v-list-item-group v-model="invites" multiple color="primary">
                                <v-list-item v-for="(invite, index) in mp_invites" :key="index">
                                    <template v-slot:default="{ active }">
                                        <v-list-item-icon>
                                            <IconSm :src="invite.group_image_name" />
                                        </v-list-item-icon>
                                        <v-list-item-content>
                                            <v-list-item-title v-text="invite.group_name"></v-list-item-title>
                                        </v-list-item-content>
                                        <v-list-item-content>
                                            <v-list-item-title><router-link :to="{ name: 'friend.show', params: { 'user_id': invite.user_id } }">{{invite.nickname}}</router-link></v-list-item-title>
                                        </v-list-item-content>
                                        <v-checkbox
                                        :input-value="active"
                                        color="primary"
                                        ></v-checkbox>
                                    </template>
                                </v-list-item>
                            </v-list-item-group>
                        </v-list>
                    </v-card-text>
                    <v-card-text class="pa-1">
                        <v-row justify="center">
                            <v-col class="text-center">
                                <v-btn color="primary" @click="onJoin">参加</v-btn>
                            </v-col>
                            <v-col class="text-center">
                                <v-btn color="primary" @click="onReject">拒否</v-btn>
                            </v-col>
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
                                        <Edit @update="onEdit" :name="'掲示板'" :image="null" :is_topic="false" />
                                    </v-col>
                                </v-row>
                                <v-row justify="center">
                                    <v-col cols="12" sm="8">
                                        <Detail :board="mp_b_detail"/>
                                    </v-col>
                                </v-row>
                                <v-row justify="center" v-show="mp_b_messages.length">
                                    <v-col cols="12" sm="8">
                                        <CommentList :pageSize="pageSize" :messages="mp_b_messages" />
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

import { mapState } from 'vuex'
export default {
    data () {
        return {
            nickname: "",
            detail: "",
            tab: 0,
            is_edit: false,
            pageSize: 5,       
            upload_image: null,
            invites: [],
        }
    },
    computed: mapState([ 'isLoading', 'mp_user', 'mp_b_messages', 'mp_b_detail', 'mp_invites', 'mp_groups']),

    mounted () {
        this.getItems()
    },
    methods: {
        getItems () {
            this.$store.commit('startLoading')
            const api = axios.create()
            axios.all([
                api.get('/api/user'),
                api.get('/api/group/my/invite'),
                api.get('/api/topic/favorite'),
                api.get('/api/board/message'),
            ]).then(axios.spread((res,res2,res3,res4) => {
                this.$store.commit('mypageInit', {
                    user           : res.data.user,
                    friends        : res.data.friends,
                    groups         : res.data.groups,
                    board_detail   : res.data.detail,
                    board_messages : res.data.messages,
                    invites        : res2.data,
                    favorite_topics: res3.data,
                })
                // console.log(res.data.messages.board_messages)
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.nickname = this.mp_user.nickname
                this.detail = this.mp_user.detail
                this.$store.commit('finishLoading')
            })
        },
        changeImage: function (file)  {
            this.upload_image = file
        },
        onUserUpdate () {
            this.$store.commit('startLoading')
            axios.put('/api/user/', {
                id: this.mp_user.id,
                nickname: this.nickname,
                detail: this.detail,
                upload_image: this.upload_image,
            }).then(res => {
                this.$store.commit('mypageUserUpdate', res.data)
            }).catch(error => {
                alert('変更に失敗しました。')
            }).finally(resp => {
                this.$store.commit('finishLoading')
                this.is_edit = false
            })
        },
        onSubmit (message) {
            this.$store.commit('startLoading')
            axios.post('/api/board/message', {
                message  : message,
                board_id : this.mp_user.id,
            }).then(res => {
                this.$store.commit('boardMessagePush', res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onEdit (board) {
            this.$store.commit('startLoading')
            axios.post('/api/board/', {
                name   : board.name,
                detail : board.detail,
            }).then(res=> {
                this.$store.commit('boardUpdate', res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onJoin () {
            let group_ids = []
            this.invites.forEach(index => {
                group_ids.push(this.mp_invites[index].group_id)
            })
            this.$store.commit('startLoading')
            axios.post('/api/group/join', {
                group_ids : group_ids,
            }).then(res=> {
                this.$store.commit('invitePush', res.data.join_groups)
                this.$store.commit('inviteDelete', res.data.delete_invite_ids)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onReject () {
            let group_ids = []
            this.invites.forEach(index => {
                group_ids.push(this.mp_invites[index].group_id)
            })
            this.$store.commit('startLoading')
            axios.post('/api/group/reject', {
                group_ids : group_ids,
            }).then(res=> {
                console.log(res.data)
                this.$store.commit('inviteDelete', res.data.delete_invite_ids)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })

        },
    },
    components: {
        UserSerch,
        Group,
        Friend,
        Topic,
    }

}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>