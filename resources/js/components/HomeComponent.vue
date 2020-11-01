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
        <div class="row">
            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-end mb-2">
                            <div class="col-auto"><h5>友だち一覧</h5></div>
                            <div class="col-auto">
                                <button class="btn btn-primary">追加</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>お名前</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr @click="onFriendShow(friend.id)">
                                            <!-- <td><router-link :to="{ path: '/user/' + friend.id }">{{friend.name}}</router-link></td> -->
                                            <td>{{friend.name}}</td>
                                        </tr>
                                        <!-- <tr v-for="(group, index) in groups" :key="index" @click="onShow(group.id)">
                                            <th>{{index+1}}</th>
                                            <td>{{group.name}}</td>
                                            <td>{{group.created_at | formatDate}}</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-end mb-2">
                            <div class="col-auto"><h5>グループ一覧</h5></div>
                            <div class="col-auto"><GroupCreate @update="getItems"/></div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>#</th>
                                            <th>参加中グループ名</th>
                                            <th>作成日</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(group, index) in groups" :key="index" @click="onGroupShow(group.id)">
                                            <th>{{index+1}}</th>
                                            <td>{{group.name}}</td>
                                            <td>{{group.created_at | formatDate}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
import moment from "moment";
export default {
    data () {
        return {
            user: {
                name: 'mako',
                age: 22,
                birthday: '8/26',
            },
            chat: {
                id: 1,
                name: 'd',
            },
            friend: {
                id: 1,
                name: 'fuuga',
            },
            groups: [],
            isLoading: false,
        }
    },
    computed: {
        isLogin () {
            return !(window.Laravel.api_token == "Unauthorized")
        }
    },
    mounted () {
        this.getItems()
    },
    methods: {
        onFriendShow: function (id) {
            this.$router.push({ name: 'user.show', params: { 'user_id': id} })
        },
        onGroupShow: function (id) {
            this.$router.push({ name: 'chat.group', params: { 'group_id': id} })
        },
        getItems () {
            this.isLoading = true
            axios.get('/api/group')
            .then(resp => {
                this.groups = resp.data
            }).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
            })
        },
    },
    filters: {
        formatDate (date) {
            return moment(date).format('YYYY年MM月DD日 HH時mm分')
        }
    },

}
</script>
