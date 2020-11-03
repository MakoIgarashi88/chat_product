<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="row justify-content-between">
                            <div class="col-auto"></div>
                            <div class="col-8 h3" >{{user.name}} のページ</div>
                            <div class="col-auto h3" @click="is_edit=!is_edit">
                                <button class="btn btn-light btn-outline-primary"><i class="fas fa-cog"></i></button>
                            </div>
                        </div>
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
                        <div class="row mt-3 mb-1 align-items-center">
                            <div class="col-2 text-right">ニックネーム : </div>
                            <div class="col-auto form-inline" v-if="is_edit">
                                <input type="text" class="form-control" v-model="user.nickname">
                            </div>
                            <div class="col-auto" v-else> {{user.nickname}}</div>
                        </div>
                        <div class="row mt-1 mb-1">
                            <div class="col-2 text-right">年齢 : </div>
                            <div class="col-auto">{{user.age}}</div>
                        </div>
                        <div class="row mt-1 mb-3 align-items-center">
                            <div class="col-2 text-right">誕生日 : </div>
                            <div class="col-auto">
                                <date-picker-standard v-model="user.birthday" v-if="is_edit"/>
                                <div v-else>{{user.birthday}}</div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4" v-if="is_edit">
                            <div class="col-4"><button class="btn btn-light btn-outline-primary btn-block" @click="is_edit=!is_edit">変更</button></div>
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
                            <div class="col-auto"><UserSerch/></div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>お名前</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(friend) in friends" :key="friend.id">
                                            <!-- <td><router-link :to="{ path: '/user/' + friend.id }">{{friend.name}}</router-link></td> -->
                                            <td class="user-link" @click="onFriendShow(friend.id)">{{friend.name}}</td>
                                            <td><button class="btn btn-light" @click="onMessage(friend.id)"><i class="far fa-comment-dots"> {{friend.name}}にメッセージを送信</i></button></td>
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
                                        <tr v-for="(group,index) in groups" :key="index" @click="onGroupShow(group.id)">
                                            <th>{{index+1}}</th>
                                            <td class="user-link">{{group.name}}</td>
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
import UserSerch from "./user/UserSerch"
export default {
    data () {
        return {
            user: {
                name: null,
                age: null,
                birthday: null,
            },
            chat: {
                id: 1,
                name: 'd',
            },
            friends: [
                {
                    id: 1,
                    name: 'fuuga',
                },
                {
                    id: 2,
                    name: 'changmin',
                },
                {
                    id: 3,
                    name: 'kattyan',
                }
            ],
            is_edit: false,
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
        onMessage: function (id) {
            this.$router.push({ name: 'chat.private', params: { 'user_id': id} })
        },
        getItems () {
            this.isLoading = true
            axios.get('/api/user/')
            .then(res => {
                this.user = res.data.user
                this.groups = [res.data.groups[0]]
                this.friends = res.data.friends
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
    components: {
        UserSerch
    }

}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
.user-link {
    color: $blue;
    cursor: pointer;
    text-decoration: underline;
}
</style>