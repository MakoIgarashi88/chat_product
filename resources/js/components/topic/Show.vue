<template>
    <v-container>
        <v-card outlined>
            <v-row>
                <v-col class="pa-5 text-left">
                    <BackButton />
                </v-col>
                <v-col class="pa-5 text-right">
                    <v-btn text icon v-if="favorite" @click="favoriteChange"><v-icon x-large color="primary">mdi-bookmark</v-icon></v-btn>
                    <v-btn text icon v-else @click="favoriteChange"><v-icon x-large color="primary">mdi-bookmark-outline</v-icon></v-btn>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col cols="12" sm="3" class="text-center">
                    <IconLg :src="topic.image_name" />
                </v-col>
                <v-col cols="12" sm="8">
                    <v-row>
                        <v-col cols="12" class="text-right">
                            <Edit @update="onEdit" :name="'トピック'" :image="topic.image_name" :is_topic="true" />
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
            <v-row justify="center" v-show="topic_messages.length">
                <v-col cols="12" sm="8">
                    <CommentList :messages="topic_messages" :pageSize="pageSize"/>
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
import { mapState } from 'vuex'
export default {
    props: ['topic_id'],
    data () {
        return {
            pageSize: 20,
            favorite: false,
        }
    },
    mounted() {
        this.getItems()
    },
    computed: mapState([ 'topic', 'topic_messages', 'is_favorite']),
    methods: {
        getItems() {
            axios.get('/api/topic/' + this.topic_id)
            .then(res => {
                this.$store.commit('topicInit', {
                    topic       : res.data.topic,
                    messages    : res.data.messages,
                    is_favorite : res.data.is_favorite,
                })
                this.favorite = res.data.is_favorite
                // console.log(this.favorite)
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
            }).then(res => {
                this.$store.commit('topicMessagePush', res.data)
            })
            .catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        },
        onEdit(topic) {
            this.$store.commit('startLoading')
            axios.post('/api/topic/detail', {
                topic_id     : this.topic_id,
                name         : topic.name,
                detail       : topic.detail,
                upload_image : topic.image,
            }).then(res => {
                console.log(res.data)
            }).catch(error => {
                alert('送信に失敗しました。')
            }).finally(res => {
                this.getItems()
                this.$store.commit('finishLoading')
            })
        },
        favoriteChange() {
            this.$store.commit('startLoading')
            axios.post('/api/topic/favorite', {
                favorite : !(this.favorite),
                topic_id : this.topic_id,
            }).then(res => {
                this.$store.commit('isFavoriteChange')
                this.favorite = this.is_favorite
                // console.log(res.data)
            }).catch(error => {
                alert('失敗しました')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        }
    },
}
</script>

<style lang="scss" scoped>

</style>