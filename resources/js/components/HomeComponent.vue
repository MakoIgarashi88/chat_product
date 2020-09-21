<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col"><h5>チャットアプリ</h5></div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        <router-link :to="{ name: 'user' }" class="btn btn-primary " v-if="isLogin">ユーザー</router-link>
                    </div>
                    <div class="col-auto">
                        <router-link :to="{ name: 'group' }" class="btn btn-primary ">グループ</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted () {
        // this.getItems()
    },
    computed: {
        isLogin () {
            return !(window.Laravel.api_token == "Unauthorized")
        }
    },
    methods: {
        getItems: function () {
            axios.get('/api/user')
            .then(resp => {
                console.log(resp)
                this.users = resp.data
            }).catch(error => {
                // alert(error)
            })
        },
    }
}
</script>
