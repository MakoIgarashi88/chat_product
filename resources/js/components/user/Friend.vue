<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="col-auto h3">{{user.name}} のページ</div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div>サムネイルを表示</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                プロフィール
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-auto">年齢 : {{user.age}}</div>
                            <div class="col-auto">誕生日 : {{user.birthday}}</div>
                            <p>シークレット情報</p>
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <div class="btn btn-primary" @click="onFriendApply()">友達申請</div>
            </div>
            <div class="col">
                <div class="btn btn-primary" @click="onMessage()">メッセージを送信</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user_id'],
    data () {
        return {
            user: {
                id: 1,
                name: 'fuuga',
                age: 22,
                birthday: '8/27',
            },
            chat: {
                name: 'd',
            },
            friend: {
                id: 1,
                name: 'fuuga',
            },
            isLoading: false,
        }
    },
    mounted () {
        //
    },
    methods: {
        onFriendApply: function () {
            if (confirm('友達申請をしますか？'))　{
                console.log('友達申請する処理')
            }
        },
        onMessage: function () {
            this.$router.push({ name: 'chat.private', params: { 'user_id': this.user.id} })
        },
        // onShow: function (id) {
        //     this.$router.push({ name: 'user.show', params: { 'user_id': id} })
        // }
    }
}
</script>
