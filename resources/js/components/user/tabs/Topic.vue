<template>
    <div>
        <v-card v-if="!mp_f_topics.length">
            <v-row justify="center">
                <v-col cols="11">
                    <p>お気に入りのトピックはありません。</p>
                    <p>好きな単語で検索して、色んな<router-link to="/topic">トピック</router-link>に出会いましょう！</p>
                    <p>※気になったトピックは、右上の<v-icon color="primary">mdi-bookmark-outline</v-icon>を押してお気に入り登録しよう！</p>
                </v-col>
            </v-row>
        </v-card>
        <v-card v-else>
            <v-row justify="center">
                <v-col cols="11">
                    <v-card outlined>
                        <v-list>
                            <v-list-item-group>
                                <template v-for="(topic, index) in displayLists">
                                    <v-list-item :key="topic.name">
                                        <template>
                                            <v-list-item-avatar>
                                              	<IconSm :src="topic.image_name" />
                                            </v-list-item-avatar>
                                            <v-list-item-content>
                                                
                                                <v-list-item-title>
                                                    <router-link :to="{ name: 'topic.show', params: { 'topic_id': topic.id } }">
                                                        {{topic.name}}
                                                    </router-link>
                                                </v-list-item-title>
                                                <v-list-item-subtitle v-text="topic.detail"></v-list-item-subtitle>
                                            </v-list-item-content>
                                        </template>
                                    </v-list-item>
                                    <v-divider v-if="index < mp_f_topics.length - 1" :key="index"></v-divider>
                                </template>
                            </v-list-item-group>
                        </v-list>
    
                        <v-divider></v-divider>
                        <PageNation :pageCount="pageCount" v-show="pageCount>1" @getPage="pageChange"/>
                    </v-card>
                </v-col>
            </v-row>
        </v-card>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
	data () {
		return {
            selected: [2],
            pageSize: 5,
            displayLists: [],
		}
    },
    computed: {
        ...mapState([ 'mp_f_topics' ]),
        pageCount () {
            return Math.ceil(this.mp_f_topics.length / this.pageSize)
        },
    },
    methods: {
        pageChange: function (pageNumber) {
            // pageSize: 5
            // pageNumber: 1
            // this.displayLists = this.mp_friends.splice(this.pageSize*(pageNumber-1), this.pageSize)
            this.displayLists = this.mp_f_topics.slice(this.pageSize*(pageNumber-1),this.pageSize*(pageNumber));
        }
    },
    mounted () {
        this.displayLists = this.mp_f_topics.slice(0,this.pageSize);
    },

}
</script>

<style lang="scss" scoped>

</style>