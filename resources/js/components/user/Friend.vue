<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="col-auto">{{user.name}} のページ</div>
                    </div>

                    <div class="card-body">
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
                <div class="btn btn-primary">メッセージを送信する</div>
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
        // onShow: function (id) {
        //     this.$router.push({ name: 'user.show', params: { 'user_id': id} })
        // }
    }
}
</script>
