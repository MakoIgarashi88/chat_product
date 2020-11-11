<template>
    <div>
        <button class="btn btn-light" @click="modal=true"><i class="fas fa-bars"></i></button>

        <default-modal @close="modal=false" v-if="modal">

            <template slot="header">
                <h5 class="modal-title">
                    <button class="btn" :class="mode == 'join' ? 'btn-primary' : 'btn-light'" @click="mode='join'"><i class="far fa-user"></i> 参加者</button>
                    <button class="btn" :class="mode == 'invite' ? 'btn-primary' : 'btn-light'" @click="mode='invite'"><i class="far fa-envelope"></i> 招待</button>
                    <button class="btn" :class="mode == 'edit' ? 'btn-primary' : 'btn-light'" @click="mode='edit'"><i class="far fa-edit"></i> 編集</button>
                    <button class="btn btn-dark" @click="onLeave"><i class="fas fa-door-open"></i> 退会</button>
                </h5>
            </template>

            <template slot="body">
                <table class="table table-hover" v-if="mode == 'join'">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>参加中ユーザー</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="index">
                            <th>{{index+1}}</th>
                            <td><span @click="onShow(user.id)" class="user-link">{{user.name}}</span></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover" v-else-if="mode == 'invite'">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>友だちリスト</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(friend, index) in friends" :key="index">
                            <th>{{index+1}}</th>
                            <td><span @click="onShow(friend.id)" class="user-link">{{friend.name}}</span></td>
                            <td><input type="checkbox" :value="friend.id" v-model="invite_ids"></td>
                        </tr>

                    </tbody>
                </table>
                <table class="table table-hover" v-else-if="mode == 'edit'">
                    <tbody>
                        <div class="row">
                            <div class="col-md-3 align-self-center text-left text-md-center">ルーム名:</div>
                            <div class="col-md-9"><input type="text" class="form-control" v-model="group.name"></div>
                        </div>
                    </tbody>
                </table>
            </template>
            <template slot="footer">
                <button class="btn btn-primary" v-show="mode=='invite'" @click="onInvite()">招待</button>
                <button class="btn btn-primary" v-show="mode=='edit'" @click="onEdit()">編集</button>
            </template>

            <!-- <tr v-for="(group, index) in groups" :key="index" @click="onGroupShow(group.id)">
                <th>{{index+1}}</th>
                <td>{{group.name}}</td>
                <td>{{group.created_at | formatDate}}</td>
            </tr> -->

        </default-modal>
    </div>
</template>

<script>
export default {
    props: ['group_id'],
    data () {
        return {
            users: [],
            friends: [],
            invite_ids: [],
            group: [],
            mode: 'join',
            modal: false,
            isLoading: false,
        }
    },
    mounted () {
        this.getItems()
    },
    methods: {
        getItems () {
            this.isLoading = true
            const api = axios.create()
            axios.all([
                api.get('/api/group/list/' + this.group_id),
                api.get('/api/friend/invite/list/' + this.group_id),
                api.get('/api/group/' + this.group_id)
            ]).then(axios.spread((users,friends,group) => {
                this.users = users.data
                this.friends = friends.data
                this.group = group.data
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
            })
        },
        onLeave () {
            if ( confirm('本当に退会しますか？')) {
                axios.delete('/api/group/leave/' + this.group_id)
                .then(res => {
                    alert('退会しました')
                    this.$router.push({ name: 'home' })
                }).catch(error => {
                    alert(error)
                })
            }
        },
        onInvite () {
            axios.post('/api/invite/', {
                friend_ids: this.invite_ids,
                group_id: this.group_id,
            }).then(res => {
                alert(res.data)
            }).catch(error => {
                alert(error)
            })
        },
        onShow: function (id) {
            this.$router.push({ name: 'user.show', params: { 'user_id': id} })
        },
        onEdit () {
            axios.put('/api/group/edit', {
                group_id: this.group_id,
                group_name: this.group.name
            }).then(res => {
                alert(res.data)
                this.$emit('update')
            }).catch(error => {
                alert('名前の変更に失敗しました')
            })
        }
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