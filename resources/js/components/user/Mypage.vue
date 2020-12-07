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
                                <v-btn outlined color="primary"><i class="fas fa-cog"></i></v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" v-if="is_edit">
                                <FileUp :image_name="user.image_name" @change="changeImage" />
                            </v-col>
                            <v-col cols="12" sm="3" class="text-center" v-else>
                                <IconLg :src="user.image_name" />
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
                                <v-row justify="center">
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
        <b-loading :isLoading.sync="isLoading" />
    </v-container>

</template>

<script>
import moment from "moment";
import UserSerch from "./UserSerch"
import MypageTabs from "./MypageTabs"
import { mapState } from 'vuex'
// import { mdiCogOutline } from '@mdi/js';
export default {
    data () {
        return {
            user: {
                id: null,
                name: null,
                nickname: null,
                image_id: null,
                image_name: null,
                detail: "",
            },
            is_edit: false,
            upload_image: null,
        }
    },
    computed: mapState([ 'isLoading' ]),
    mounted () {
        this.getItems()
    },
    methods: {
        getItems () {
            this.$store.commit('startLoading')
            const api = axios.create()
            axios.all([
                api.get('/api/user'),
                api.get('/api/invite'),
                api.get('/api/topic/favorite')
            ]).then(axios.spread((res,res2,res3) => {
                this.user = res.data.user
                this.$store.commit('mypageInit', {
                            user   : res.data.user,
                            friends: res.data.friends,
                            groups : res.data.groups,
                            invites: res2.data,
                    favorite_topics: res3.data,
                })
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.$store.commit('finishLoading')
            })
        },
        changeImage: function (file)  {
            this.upload_image = file
        },
        onUserUpdate () {
            this.$store.commit('startLoading')
            axios.put('/api/user/', {
                id: this.user.id,
                nickname: this.user.nickname,
                upload_image: this.upload_image
            }).then(res => {
                this.$store.commit('mypageUserUpdate', {
                    user: res.data
                })
            }).catch(error => {
                alert('変更に失敗しました。')
            }).finally(resp => {
                this.$store.commit('finishLoading')
                this.is_edit = false
                this.getItems()
            })
        },
    },
    components: {
        UserSerch,
        MypageTabs
    }

}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
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