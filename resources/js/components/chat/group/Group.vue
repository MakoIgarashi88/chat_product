<template>
    <div>
        <v-row justify="center">
            <v-col cols="12" sm="10">
                <v-card>
                    <v-card-title>
                        <v-row>
                            <v-col class="text-center">
                                <HomeButton />
                            </v-col>
                            <v-col class="text-center">
                                {{group.name}}
                            </v-col>
                            <v-col class="text-center">
                                <GroupSetting @change="getItems" />
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-divider></v-divider>
                        <v-card-text>
                            <Message v-for="message in messages" :key="message.id" :message="message"/>
                        </v-card-text>
                    <v-divider></v-divider>
                    <v-card-text class="pt-0 pb-0">
                        <v-row justify="center" align="center">
                            <v-col>
                                <v-textarea
                                auto-grow 
                                outlined 
                                rows="1" 
                                row-height="15" 
                                hide-details
                                v-model="message"
                                ></v-textarea>
                            </v-col>
                            <v-col cols="auto">
                                <SendButton @submit="onStore"/>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
import { mapState } from 'vuex'
import GroupSetting from '../group/GroupSetting.vue'
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
        }
    },    mounted () {
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
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.message = ""
                this.getMessages()
            })
        },
    },
    components: {
        GroupSetting,
    }
}
</script>
