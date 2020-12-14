<template>
    <v-container>
        <v-card outlined>
            <v-row>
                <v-col>
                    <div class="pa-5"><BackButton /></div>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col cols="12" sm="3" class="text-center">
                    <IconLg :src="topic.image_name" />
                </v-col>
                <v-col cols="12" sm="8">
                    <v-row>
                        <v-col cols="12" class="text-right">
                            <Edit @update="onEdit" :name="'トピック'"/>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <Detail :board="topic" />
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-card>
        <v-card outlined class="mt-2">
            <v-row justify="center">
                <v-col cols="12" sm="8">
                    <CommentList :page="page" :pageCount="pageCount" :messages="messages"/>
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="8">
                    <MessageForm @submit="onSubmit"/>
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
export default {
    props: ['topic_id'],
    data () {
        return {
            topic: {},
            image: '/storage/images/QPZUNpPqoz4RPHY2.png',
            messages: [],
            page: 0,
            pageCount: 0,
        }
    },
    mounted() {
        this.getItems()
    },
    methods: {
        getItems() {
            axios.get('/api/topic/' + this.topic_id)
            .then(res => {
                this.topic = res.data.topic
                this.messages = res.data.messages
            }).catch(error => {
                alert('トピック情報が読み込めませんでした。')
            })
        },
        onSubmit (message) {
            // console.log(this.topic_id)
            this.$store.commit('startLoading')
            axios.post('/api/topic/message', {
                message  : message,
                topic_id : this.topic_id,
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onEdit(topic) {
            this.$store.commit('startLoading')
            axios.post('/api/topic/detail', {
                topic_id : this.topic_id,
                name     : topic.name,
                detail   : topic.detail,
            }).then(res => {
                console.log(res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.getItems()
                this.$store.commit('finishLoading')
            })
        },
    },
}
</script>

<style lang="scss" scoped>

</style>