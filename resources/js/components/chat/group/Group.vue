<template>
    <div>
        <v-card class="top-fixed">
            <v-card-title class="pa-2">
                <v-row>
                    <v-col cols="2" class="text-center">
                        <HomeButton />
                    </v-col>
                    <v-col cols="8" class="text-center">
                        {{group.name}}
                    </v-col>
                    <v-col cols="2" class="text-center">
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
                <v-form ref="form">
                    <v-row justify="center">
                        <v-col class="py-2 pl-4 pr-0">
                            <v-textarea
                            outlined 
                            rows="2"
                            v-model="message"
                            :error-messages="errorMessage(message)"
                            ></v-textarea>
                        </v-col>
                        <v-col cols="auto" class="px-3 py-2">
                            <SendButton @submit="onStore" :disabled="!message || message.length > 200" />
                        </v-col>
                    </v-row>
                </v-form>
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
    computed: mapState([ 'isLoading', 'group' ]),
    computed: {
        isLoading: {
            get () { return this.$store.state.isLoading },
            set () {}
        },
        errorMessage () {
            return function (message) {
                return message.length > 200 ? "200文字以内で入力してください" : ""
            }
        }
    },
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
            if (!this.$refs.form.validate()) return
            axios.post('/api/group/message/', {
                group_id: this.group_id,
                body: this.message,
            }).then(resp => {
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
            this.getItems()
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
</style>