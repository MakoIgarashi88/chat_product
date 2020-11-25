<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card outlined>
                    <v-card-title>
                        <v-row class="justify-space-between">
                            <v-col cols="auto">
                                {{user.name}}のページ
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col cols="auto" @click="is_edit=!is_edit">
                                <!-- <v-icon>mdi-cog-outline</v-icon> -->
                                <button class="btn btn-light btn-outline-primary"><i class="fas fa-cog"></i></button>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" v-if="is_edit">
                                <v-row>
                                    <v-col cols="12" class="text-center">
                                        <img :src="upload_image" class="cut rounded-circle mt-2" v-show="upload_image">
                                        <img :src="user.image_name" class="cut rounded-circle mt-2" v-show="!upload_image">
                                    </v-col>
                                    <v-col cols="12" class="text-center">
                                        <div class="file-uploder">
                                            画像を選択してください
                                            <input type="file" @change="changeImage" accept="image/*">
                                        </div>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12" sm="3" class="text-center" v-else>
                                <img class="cut rounded-circle" :src="user.image_name">
                            </v-col>
                            <v-col cols="12" sm="9">
                                <!--ニックネーム-->
                                <v-row>
                                    <v-col>
                                        <v-text-field
                                            label="ニックネーム"
                                            :disabled="!is_edit"
                                            outlined
                                            type="text"
                                            v-model="user.nickname"
                                        />
                                    </v-col>
                                </v-row>
                                <!--自己紹介欄-->
                                <v-row>
                                    <v-col v-if="is_edit || user.detail.length">
                                        <v-textarea
                                            :label="is_edit || user.detail.length ? '自己紹介欄' : null"
                                            :disabled="!is_edit"
                                            auto-grow
                                            outlined
                                            rows="1"
                                            v-model="user.detail"
                                        />
                                    </v-col>
                                    <!-- <v-col v-else-if="!is_edit && user.detail.length">
                                        <v-textarea name="input-7-4"  v-model="user.detail"></v-textarea>
                                    </v-col> -->
                                </v-row>
                            </v-col>
                            <v-row class="mt-4 justify-center" v-show="is_edit">
                                <v-col cols="4">
                                    <v-btn outlined color="primary" block @click="onUserUpdate">変更</v-btn>
                                </v-col>
                            </v-row>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <MypageTabs />
            </v-col>
        </v-row>
        <div class="row justify-content-center" v-if="invites.length">
            <div class="col-12">
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
                                            <th class="text-center">グループ名</th>
                                            <th class="text-center">招待人</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(invite,index) in invites" :key="index">
                                            <td align="center">{{ invite.group_name }}</td>
                                            <td align="center" class="user-link" @click="onFriendShow(invite.friend_id)">{{ invite.friend_name }}</td>
                                            <td align="center">
                                                <button class="btn-responsive btn btn-outline-success" @click="onJoin(invite.group_id)"><i class="fas fa-check"></i></button>
                                                <button class="btn-responsive btn btn-outline-danger" @click="onReject(invite.id)"><i class="fas fa-times"></i></button>
                                            </td>
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
    </v-container>

</template>

<script>
import moment from "moment";
import UserSerch from "./UserSerch"
import MypageTabs from "./MypageTabs"
// import { mdiCogOutline } from '@mdi/js';
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
                detail: "",
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
                this.user.detail = 'sample'
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
        UserSerch,
        MypageTabs
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
.btn-responsive {
    padding: .5rem 1rem;
    width: 3rem;
}
@media screen and (max-width: 768px) {
/* 768pxまでの幅の場合に適応される */
    .btn-responsive {
        padding: 0;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
    }
    .col-12 {
        padding: 0;
    }
}
</style>