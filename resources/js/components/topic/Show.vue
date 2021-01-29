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
                            <TopicEdit
                             :topic_id="topic_id"
                             :image="topic.image_name" 
                             :old_title="topic.name" 
                             :old_detail="topic.detail"
                             :old_tags="topic.tags"
                             />
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col>
                            <Detail :board="topic" />
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col class="pa-0">
                            <v-chip-group>
                                <v-chip
                                    v-for="(tag,index) in topic.tags" :key="index"
                                    small
                                    color="tag" 
                                    text-color="white" 
                                    >
                                    {{ tag }}
                                </v-chip>
                            </v-chip-group>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-card>
        <v-card outlined class="mt-2">
            <v-row justify="center" v-show="topic_messages.length">
                <v-col cols="12" sm="8">
                    <CommentList :messages="topic_messages" :pageSize="pageSize" :place="'topic'" />
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="8">
                    <MessageForm @submit="onSubmit"/>
                </v-col>
            </v-row>
        </v-card>
        <b-loading :isLoading.sync="isLoading" />
    </v-container>
</template>

<script>
import { mapState } from 'vuex'
import TopicEdit from './TopicEdit.vue'
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
    computed: mapState(['isLoading', 'topic', 'topic_messages', 'is_favorite']),
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
            }).catch(error => {
                alert('トピック情報が読み込めませんでした。')
            })
        },
        onSubmit (message) {
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
    components: {
        TopicEdit,
    }
}
</script>

<style lang="scss" scoped>

</style>