<template>
    <div>
        <v-row v-for="( friend, index ) in friends" :key="index">
            <v-col class="text-center">
                id:{{friend.id}}
                <br />
                name:{{friend.name}}
                <br />
                nickname:{{friend.nickname}}
                <br />
                detail:{{friend.detail}}
            </v-col>
        </v-row>
    </div>
</template>

<script>
// import { mapState } from 'vuex'
export default {
    data () {
        return {
            // friend: {
            //     id: null,
            //     name: null,
            //     nickname: null,
            //     image_id: null,
            //     image_name: null,
            //     detail: "",
            // },
            friends: [],
            groups: [],
            invites: [],
        }
    },
    computed: {
        // ...mapState([ 'friends' ])
    },
    mounted () {
        this.getItems()
    },
    methods: {
        getItems () {
            this.isLoading = true
            const api = axios.create()
            axios.all([
                api.get('/api/user'),
                api.get('/api/invite'),
            ]).then(axios.spread((res,res2) => {
                this.user = res.data.user
                this.user.detail = 'sample'
                this.friends = res.data.friends
                this.groups = res.data.groups
                this.invites = res2.data
                this.$store.commit('mypageInit', {
                    user   : res.data.user,
                    friends: res.data.friends,
                    groups : res.data.groups,
                    invites: res2.data,
                })
            })).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
                this.is_edit = false
                // this.sendData()
            })
        },
        sendData () {
            console.log('通っています')
            this.$store.commit('addData', this.friends)
            // this.$store.commit('addData', {
            //     friend: {
            //         id: this.id,
            //         name: this.name,
            //         nickname: this.nickname,
            //         image_id: this.image_id,
            //         image_name: this.image_name,
            //         detail: this.detail,
            //     }
            // })
        }
    }

}
</script>