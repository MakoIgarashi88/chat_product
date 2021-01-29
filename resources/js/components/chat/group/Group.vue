<template>
    <div>
        <v-card class="top-fixed">
            <v-card-title class="pa-2">
                <v-row>
                    <v-col class="text-center">
                        <HomeButton />
                    </v-col>
                    <v-col class="text-center">
                        {{group.name}}
                    </v-col>
                    <v-col class="text-center">
                        <!-- <GroupSetting @change="getItems" /> -->
                        <v-dialog v-model="dialog" persistent max-width="600px">
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn v-bind="attrs" v-on="on" color="primary">
                                    <i class="fas fa-bars"></i>
                                </v-btn>
                            </template>

                            <v-card>
                                <v-tabs v-model="tab" background-color="secondary" centered dark icons-and-text>
                                    <v-tabs-slider></v-tabs-slider>

                                    <v-tab>
                                        参加者
                                        <v-icon>mdi-account-multiple</v-icon>
                                    </v-tab>

                                    <v-tab>
                                        招待
                                        <v-icon>mdi-email</v-icon>
                                    </v-tab>

                                    <v-tab>
                                        編集
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-tab>
                                    <v-tab>
                                        退会
                                        <v-icon>mdi-exit-to-app</v-icon>
                                    </v-tab>
                                </v-tabs>

                                <v-tabs-items v-model="tab">
                                    <v-tab-item>
                                        <Member />
                                    </v-tab-item>
                                    <v-tab-item>
                                        <Invite @close="dialog=false" />
                                    </v-tab-item>
                                    <v-tab-item>
                                        <Edit @change="onEdit" />
                                    </v-tab-item>
                                    <v-tab-item>
                                        <Unsubscribed :group_id="group_id" />
                                    </v-tab-item>
                                </v-tabs-items>
                                
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn color="blue darken-1" text @click="dialog=false">
                                        Close
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-col>
                </v-row>
            </v-card-title>
        </v-card>
        <v-card class="middle-fixed" id="chat-window">
            <v-card-text>
                <Message v-for="message in messages" :key="message.id" :message="message"/>
            </v-card-text>
        </v-card>
        <v-card class="bottom-fixed">
            <v-card-text class="pa-2">
                <v-row justify="center" align="center">
                    <v-col class="pa-2">
                        <v-textarea
                        auto-grow 
                        outlined 
                        rows="1" 
                        row-height="10" 
                        hide-details
                        v-model="message"
                        ></v-textarea>
                    </v-col>
                    <v-col cols="auto" class="py-2">
                        <SendButton @submit="onStore"/>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>

        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
import { mapState } from 'vuex'
import GroupSetting from '../group/GroupSetting.vue'
import Member from '../group/settingTabs/Member.vue'
import Invite from '../group/settingTabs/Invite.vue'
import Edit from '../group/settingTabs/Edit.vue'
import Unsubscribed from '../group/settingTabs/Unsubscribed.vue'
export default {
    props: ['group_id'],
    data () {
        return {
            group: {
                id: null,
                name: null,
                image_id: null,
                image_name: null,
                detail: "",
            },
            message: "",
            messages: [],
            dialog: false,
            tab: null,
        }
    },
    mounted () {
        this.getItems()
    },
    computed: mapState([ 'isLoading' ]),
    methods: {
        getItems () {
            this.$store.commit('startLoading')
            const api = axios.create()
            axios.all([
                api.get('/api/group/' + this.group_id),
                api.get('/api/group/member/' + this.group_id),
                api.get('/api/group/invite/' + this.group_id),
            ]).then(axios.spread((res,res2,res3) => {
                this.group = res.data
                // console.log(res3.data)
                this.$store.commit('groupInit', {
                group   : res.data,
                members : res2.data,
                invites : res3.data,
                })
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.getMessages()
            }) 
        },
        getMessages () {
            this.$store.commit('startLoading')
            axios.get('/api/group/message/' + this.group_id) 
            .then(res => {
                this.messages = res.data
            }).catch(error => {
                alert(error)
            }).finally(resp => {
                this.$store.commit('finishLoading')
                this.scrollToEnd()
            })
        },
        onStore () {
            if (!this.message) {
                alert('メッセージを入力してください。')
                return
            }
            if (this.message.length >= 200) {
                alert('メッセージは200文字以下で入力してください。')
                return
            }
            axios.post('/api/group/message/', {
                group_id: this.group_id,
                body: this.message,
            }).then(resp => {
                this.message = null
                this.scrollToEnd()
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.message = ""
                this.getMessages()
            })
        },
        // 下にスクロールする
        scrollToEnd () {
            const scrollHeight = document.getElementById("chat-window").scrollHeight;
            document.getElementById("chat-window").scrollTop = scrollHeight;
        },
        onEdit () {
            this.dialog = false
        },
    },
    components: {
        GroupSetting,
        Member,
        Invite,
        Edit,
        Unsubscribed,
    }
}
</script>
<style lang="scss">
.top-fixed {
    position: fixed; /* 要素の位置を固定する */
    top: 48px; /* 基準の位置を画面の一番下に指定する */
    width: 100%;
    height: 72px
}
.middle-fixed {
    position: fixed; /* 要素の位置を固定する */
    top: 120px; /* 基準の位置を画面の一番下に指定する */
    bottom: 85px; /* 基準の位置を画面の一番下に指定する */
    width: 100%;
    overflow: auto;
}
.bottom-fixed {
    position: fixed; /* 要素の位置を固定する */
    bottom: 0; /* 基準の位置を画面の一番下に指定する */
    width: 100%;
    height: 85px;
}
</style>