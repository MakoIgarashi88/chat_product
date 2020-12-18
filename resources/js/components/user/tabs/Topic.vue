<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
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