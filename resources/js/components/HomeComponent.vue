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
                            <!-- サムネイル -->
                            <div class="col-md-3" v-if="is_edit">
                                <div class="row">
                                    <div class="col-12 box">
                                        <img :src="upload_image" class="cut rounded-circle mt-2" v-show="upload_image">
                                        <img :src="user.image_name" class="cut rounded-circle mt-2" v-show="!upload_image">
                                    </div>
                                    <div class="col-12 box">
                                        <div class="file-uploder">
                                            画像を選択してください
                                            <input type="file" @change="changeImage" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 box" v-else>
                                <img class="cut rounded-circle" :src="user.image_name">
                            </div>
                            <div class="col-md-9">
                                <!-- ニックネーム -->
                                <div class="row mt-3 mb-1 align-items-center">
                                    <div class="col-md-3 text-md-right">ニックネーム : </div>
                                    <div class="col-auto form-inline" v-if="is_edit">
                                        <input type="text" class="form-control" v-model="user.nickname">
                                    </div>
                                    <div class="col-auto" v-else>{{user.nickname}}</div>
                                </div>
                                <!-- 年齢 -->
                                <div class="row mt-1 mb-1">
                                    <div class="col-md-3 text-md-right">年齢 : </div>
                                    <div class="col-auto">{{userAge}}</div>
                                </div>
                                <!-- 誕生日 -->
                                <div class="row mt-1 mb-3 align-items-center">
                                    <div class="col-md-3 text-md-right">誕生日 : </div>
                                    <div class="col-auto">
                                        <date-picker-standard v-model="user.birthday" v-if="is_edit"/>
                                        <div v-else>{{user.birthday}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-4" v-if="is_edit">
                            <div class="col-4"><button class="btn btn-light btn-outline-primary btn-block" @click="onUserUpdate">変更</button></div>
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
                            <div class="col-auto"><UserSerch @update="getItems"/></div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>お名前</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(friend) in paginate_frinds" :key="friend.id">
                                            <!-- <td><router-link :to="{ path: '/user/' + friend.id }">{{friend.name}}</router-link></td> -->
                                            <td class="user-link" @click="onFriendShow(friend.id)">{{friend.name}}</td>
                                            <td><button class="btn btn-light" @click="onMessage(friend.id)"><i class="far fa-comment-dots"> {{friend.name}}にメッセージを送信</i></button></td>
                                            <td><i class="far fa-lightbulb"></i></td>
                                        </tr>
                                        <!-- <tr v-for="(group, index) in groups" :key="index" @click="onShow(group.id)">
                                            <th>{{index+1}}</th>
                                            <td>{{group.name}}</td>
                                            <td>{{group.created_at | formatDate}}</td>
                                        </tr> -->
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <mg-paginate :data="friends" :count-per-page="5" @change="paginate_frinds=$event" />
                                </div>
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
                                        <tr v-for="(group,index) in paginate_groups" :key="index" @click="onGroupShow(group.id)">
                                            <th>{{index+1}}</th>
                                            <td class="user-link">{{group.name}}</td>
                                            <td>{{group.created_at | formatDate}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <mg-paginate :data="groups" :count-per-page="5" @change="paginate_groups=$event" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" v-if="invites.length">
            <div class="col ">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-auto"><h5>招待されているグループ</h5></div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <table class="table table-hover">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">グループ名</th>
                                            <th class="text-center">招待人</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(invite,index) in invites" :key="index">
                                            <td align="center">{{ index+1}}</td>
                                            <td align="center">{{ invite.group_name }}</td>
                                            <td align="center" class="user-link" @click="onFriendShow(invite.friend_id)">{{ invite.friend_name }}</td>
                                            <td align="center"><button class="btn btn-primary" @click="onJoin(invite.group_id)">承認</button></td>
                                            <td align="center"><button class="btn btn-primary" @click="onReject(invite.id)">拒否</button></td>
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
                id: null,
                name: null,
                nickname: null,
                birthday: null,
                image_id: null,
                image_name: null,
            },
            friends: [],
            paginate_frinds: [],
            is_edit: false,
            groups: [],
            paginate_groups: [],
            isLoading: false,
            invites: [],
            upload_image: null,
        }
    },
    computed: {
        isLogin () {
            return !(window.Laravel.api_token == "Unauthorized")
        },
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
        onFriendShow: function (id) {
            this.$router.push({ name: 'user.show', params: { 'user_id': id} })
        },
        onGroupShow: function (id) {
            this.$router.push({ name: 'chat.group', params: { 'group_id': id} })
        },
        onMessage: function (id) {
            this.$router.push({ name: 'chat.private', params: { 'user_id': id} })
        },
        onJoin (group_id) {
            axios.post('/api/group/' + group_id)
            .then(res => {
                console.log(res.data)
            }).catch(error => {
                alert('グループ参加に失敗しました')
            }).finally(resp => {
                this.getItems()
            })
        },
        onReject (id) {
            if (confirm('本当に参加を拒否しますか？')) {
                axios.delete('/api/invite/' + id)
                .then(resp => {
                }).catch(error => {
                    alert('グループ参加拒否に失敗しました')
                }).finally(resp => {
                    this.getItems()
                })
            }
        },
        getItems () {
            this.isLoading = true
            const api = axios.create()
            axios.all([
                api.get('/api/user/'),
                api.get('/api/invite/')
            ]).then(axios.spread((res,res2) => {
                this.user = res.data.user
                this.groups = res.data.groups
                this.friends = res.data.friends
                this.invites = res2.data
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
                this.is_edit = false
            })
        },
        async onUserUpdate () {
            this.isLoading = true
            axios.put('/api/user/', {
                id: this.user.id,
                nickname: this.user.nickname,
                birthday: this.user.birthday,
                upload_image: this.upload_image
            }).then(res => {
                console.log(res.data)
                this.getItems()
            }).catch(error => {
                alert('変更に失敗しました。')
            })
        },
        myCallBack (value) {
            console.log(value)
        },
        changeImage (e) {
            let file = e.target.files[0]
            if (file) {
                let reader = new FileReader()
                reader.readAsDataURL(file)
                reader.onload = e => {
                    this.upload_image = e.target.result
                }
            } else {
                this.upload_image = null
            }
        }
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
.cut {
    width: 7rem;
    height: 7rem;
    object-fit: contain;
    border: 1px solid $primary;
}
.box {
    display: flex;
    align-items: center;
    justify-content: center;
}
.file-uploder {
    display: inline-block;
    overflow: hidden;
    position: relative;
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    border: 1px solid $primary;
    background: $light;
    color: $primary;
    transition: background-color .3s, color .3s;
}
.file-uploder:hover {
    background-color: $primary;
    color: $light;
}
.file-uploder input[type="file"] {
    opacity: 0;
    filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
    position: absolute;
    right: 0;
    top: 0;
    margin: 0;
    font-size: 100px;
    cursor: pointer;
}
</style>