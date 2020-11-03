<template>
    <div>
        <button class="btn btn-light" @click="modal=true"><i class="fas fa-bars"></i></button>

        <default-modal @close="modal=false" v-if="modal">

            <template slot="header">
                <h5 class="modal-title">
                    <button class="btn" :class="is_invite ? 'btn-light' : 'btn-primary'" @click="is_invite=false"><i class="far fa-user"></i> 参加者</button>
                    <button class="btn" :class="is_invite ? 'btn-primary' : 'btn-light'" @click="is_invite=true"><i class="far fa-envelope"></i> 招待</button>
                    <button class="btn btn-dark" @click="onLeave"><i class="fas fa-door-open"></i> 退会</button>
                </h5>
            </template>

            <template slot="body">
                <table class="table table-hover" v-if="!is_invite">
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
                <table class="table table-hover" v-else>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>友だちリスト</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="index">
                            <th>{{index+1}}</th>
                            <td><span @click="onShow(user.id)" class="user-link">{{user.name}}</span></td>
                            <td><input type="checkbox"></td>
                        </tr>

                    </tbody>
                </table>
            </template>
            <template slot="footer">
                <button class="btn btn-primary" v-show="is_invite">追加</button>
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
    data () {
        return {
            users: [
                {
                    id: 1,
                    name: 'fuuga',
                    age: 22,
                    birthday: '8/27',
                },
                {
                    id: 2,
                    name: 'chamgmin',
                    age: 30,
                    birthday: '2/18',
                },
                {
                    id: 3,
                    name: 'kattyan',
                    age: 16,
                    birthday: '4/20',
                },
            ],
            is_invite: false,
            modal: false,
            isLoading: false,
        }
    },
    mounted () {
        //
    },
    methods: {
        onLeave: function () {
            if (confirm('退会しますか？')) {
                console.log('退会する処理')
            }
        },
        onShow: function (id) {
            this.$router.push({ name: 'user.show', params: { 'user_id': id} })
        },
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