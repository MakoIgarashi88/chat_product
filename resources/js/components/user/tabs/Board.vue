<template>
    <v-card outlined>
        <v-row>
            <v-col cols="12" sm="10" class="text-right">
                <EditButton />
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <Detail :board="mp_b_detail"/>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <CommentList :page="page" :pageCount="pageCount" :messages="mp_b_messages"/>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <MessageForm @submit="onSubmit"/>
                <!-- <v-btn @click="on">aaaa</v-btn> -->
            </v-col>
        </v-row>
    </v-card>
    
</template>

<script>
import { mapState } from 'vuex'
export default {
    data () {
        return {
            board: {
                name: 'こんにちは',
                detail: '自由に書き込んでください',
            },
            page: 1,
            pageCount: 3,
        }
    },
    computed: mapState([ 'mp_user', 'mp_b_messages', 'mp_b_detail']),
    methods: {
        onSubmit (message) {
            this.$store.commit('startLoading')
            axios.post('/api/board/message', {
                message  : message,
                board_id : this.mp_user.id,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>