<template>
    <v-card outlined>
        <v-row>
            <v-col class="text-center">
                <v-btn color="primary" @click="onRemove">退会</v-btn>
            </v-col>
            <v-col class="text-center">
                <v-btn color="primary" @click="onDelete">グループの削除</v-btn>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
import { mapState } from 'vuex'
export default {
    props: ['group_id'],
    computed: mapState([ 'members' ]),
    methods: {
        onRemove () {
            if(confirm('本当に退会しますか')) {
                axios.delete('/api/group/leave/' + this.group_id)
                    .then(res => {
                        // this.$emit('close')
                        this.$router.push({ path: '/mypage' })
                    })
                    .catch(error => {
                        alert('削除に失敗しました。')
                    })
            }
        },
        onDelete () {
            if(confirm('本当にグループを消去しますか')) {
                axios.delete('/api/group/delete/' + this.group_id)
                .then(res => {
                    console.log(res.data)
                    this.$router.push({ path: '/mypage' })
                })
                .catch(error => {
                    alert(error)
                })
            }
        }
    }
}
</script>