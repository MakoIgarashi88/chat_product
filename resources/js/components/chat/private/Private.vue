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
                                {{friend.name}}
                            </v-col>
                            <v-col class="text-center">
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
export default {
    props: ['friend_id'],
    data () {
        return {
            friend: {
                id: null,
                name: null,
                nickname: null,
                image_id: null,
                image_name: null,
                detail: "",
            },
            message: "",
            messages: [],
        }
    },
    mounted () {
        this.getItems()
    },
    computed: mapState([ 'isLoading' ]),
    methods: {
        getItems () {
            axios.get('/api/friend/' + this.friend_id) 
            .then(res => {
                this.friend = res.data.user
            }).catch(error => {
                alert(error)
            }).finally(resp => {
                this.getMessages()
            }) 
        },
        getMessages () {
            this.$store.commit('startLoading')
            axios.get('/api/private/message/' + this.friend_id) 
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
            axios.post('/api/private/message/', {
                friend_id: this.friend_id,
                body: this.message,
            }).then(resp => {
                this.message = null
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.message = ""
                this.getMessages()
            })
        }
    },
}
</script>
