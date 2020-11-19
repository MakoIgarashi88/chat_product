<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="row justify-content-center">
                            <div class="col-auto"></div>
                            <div class="col-8 h3" >{{user.name}} のページ</div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div>{{user.image_name}}</div>
                                <div><img :src="user.image_name" class="cut rounded-circle mt-2"></div>
                            </div>
                        </div>
                        <div class="row mt-3 mb-1 align-items-center">
                            <div class="col-2 text-right">ニックネーム : </div>
                            <div class="col-auto"> {{user.nickname}}</div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-2 text-right">年齢 : </div>
                            <div class="col-auto">{{userAge}}</div>
                        </div>
                        <div class="row mt-1 mb-3 align-items-center">
                            <div class="col-2 text-right">誕生日 : </div>
                            <div class="col-auto">
                                <div>{{user.birthday}}</div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col" v-if="user.is_friend">
                <div class="btn btn-primary" @click="onMessage()">メッセージを送信</div>
            </div>
            <div class="col" v-else>
                <div class="btn btn-primary" @click="onFriendApply()">友達申請</div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
export default {
    props: ['user_id'],
    data () {
        return {
            user: {
                id: null,
                name: null,
                nickname: null,
                birthday: null,
                image_id: null,
                image_name: null,
                is_friend: false,
            },
            isLoading: false,
        }
    },
    computed: {
        userAge () {
            if (!this.user.birthday) return ''
            let birthday = moment(this.user.birthday)
            return moment().diff(birthday, 'years')
        }
    },
    mounted () {
        this.getItems()
    },
    methods: {
            getItems () {
            this.isLoading = true
            axios.get('/api/friend/' + this.user_id)
            .then(res => {
                this.user = res.data
            }).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
            })
        },
        onFriendApply() {
            if(confirm('友達申請をします')) {
                axios.post('/api/friend/add/', {
                    friend_id: this.user_id,
                }).then(res => {
                    if (res.data.message.length) {
                        alert(res.data.message)
                    } else {
                        alert('友だちになりました。')
                        this.getItems()
                    }
                }).catch(error => {
                    alert('友だちの追加に失敗しました。')
                })
            }
        },
        onMessage: function () {
            this.$router.push({ name: 'chat.private', params: { 'user_id': this.user.id} })
        },
    }
}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
.cut {
    width: 7rem;
    height: 7rem;
    object-fit: contain;
    border: 1px solid $primary;
}
</style>