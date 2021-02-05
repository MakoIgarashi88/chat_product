<template>
    <div>  
        <v-card class="top-fixed">
            <v-card-title class="pa-2">
                <v-row>
                    <v-col class="text-center">
                        <HomeButton />
                    </v-col>
                    <v-col class="text-center">
                        {{friend.nickname}}
                    </v-col>
                    <v-col class="text-center">
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
                            outlined 
                            rows="2"
                            v-model="message"
                            :error-messages="errorMessage(message)"
                            ></v-textarea>
                    </v-col>
                    <v-col cols="auto" class="py-2">
                        <SendButton @submit="onStore" :disabled="!message || message.length > 200" />
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
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
    computed: {
        ...mapState([ 'isLoading' ]),
        errorMessage () {
            return function (message) {
                return message.length > 200 ? "200文字以内で入力してください" : ""
            }
        }
    },
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
                this.scrollToEnd()
            })
        },
        onStore () {
            axios.post('/api/private/message/', {
                friend_id: this.friend_id,
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
        }
    },
}
</script>
<style lang="scss" scoped>
</style>