<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <div class="row justify-content-between">
                            <div class="col-1">
                                <button class="btn btn-light" @click="onBack"><i class="fas fa-arrow-left"></i></button>
                            </div>
                            <div class="col-auto">
                                <span class="h3">{{friend.name}}</span>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>

                    <div class="card-body chat-body">
                        <div v-for="message in messages" :key="message.id">
                            <div class="row" v-if="message.is_myself">
                                <div class="col">
                                    <div class="media w-50 ml-auto mb-3">
                                        <div class="media-body">
                                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-white">{{message.body}}</p>
                                            </div>
                                            <p class="small text-muted text-right">{{message.created_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" v-else>
                                <div class="col">
                                    <div class="media w-50 mb-3"><img src="/storage/images/amaterasu.png" alt="user" width="50" class="rounded-circle">
                                        <div class="media-body ml-3">
                                            <div class="bg-light rounded py-2 px-3 mb-2">
                                                <p class="text-small mb-0 text-muted">{{message.body}}</p>
                                            </div>
                                            <p class="small text-muted text-right">{{message.created_at}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="card-footer p-1">
                        <div class="bg-white">
                            <div class="input-group">
                                <!-- <textarea placeholder="メッセージを入力してください" class="form-message form-control bg-light" v-model="message"></textarea> -->
                                <input
                                    v-model="message"
                                    @keyup.enter.ctrl="onStore"
                                    type="text"
                                    placeholder="メッセージを入力してください"
                                    class="form-control rounded-0 border-0 py-4 bg-white">
                                <div class="input-group-append">
                                    <button class="btn btn-link" type="button" @click="onStore">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </footer>

                </div>
            </div>
        </div>
        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
export default {
    props: ['user_id'],
    data () {
        return {
            friend: [],
            message: null,
            messages: [],
            isLoading: false,
        }
    },
    mounted () {
        this.getInit()
        // Echo.channel('chat').listen('MessageCreated', (e) => {
        //     this.getMessage()
        // })
    },
    methods: {
        getInit () {
            axios.get('/api/friend/' + this.user_id)
            .then(resp => {
                this.friend = resp.data
            }).catch(error => {
                alert('グループ情報が読み込めませんでした。')
                this.onBack()
            }).finally(resp => {
                this.getMessage()
            })
        },
        getMessage () {
            this.isLoading = true
            axios.get('/api/private/message/' + this.user_id)
            .then(resp => {
                this.messages = resp.data
            }).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
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
                friend_id: this.user_id,
                body: this.message,
            }).then(resp => {
                this.message = null
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.getInit()
            })
        },
        onBack () {
            this.$router.go(-1)
        },
        onDeleted () {

        }
    },
}
</script>
<style lang="scss" scoped>
.chat-body {
    height: 60vh;
    overflow: auto;
}
.form-message {
    border: none;
    resize: none;
    margin: 0;
}
</style>