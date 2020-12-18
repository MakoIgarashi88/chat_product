<template>
    <v-container>
        <v-row class="justify-center">
            <v-col cols="12">
                <section class="home">
                    <HomeHero/>
                </section>
                <v-card outlined>
                    <v-row justify="center">
                        <v-col cols="8">
                            <v-card outlined>
                                <v-card-title class="justify-center pa-3">
                                    人気トピック
                                </v-card-title>
                            </v-card>
                        </v-col>
                        <v-col cols="11">
                            <v-expansion-panels>
                            <v-expansion-panel v-for="(item,index) in topics" :key="index">
                                <v-expansion-panel-header class="py-2">
                                    <v-row align="center">
                                        <v-col cols="auto" class="py-1 pr-4">
                                            <IconSm :src="item.image_name" />
                                        </v-col>
                                        <v-col class="pa-1 ">
                                            <router-link :to="{ name: 'topic.show', params: { 'topic_id': item.id } }">
                                                {{item.name}}
                                            </router-link>
                                        </v-col>
                                    </v-row>
                                    <v-spacer></v-spacer>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-row>
                                        <v-col cols="12">
                                            {{item.detail}}
                                        </v-col>
                                        <v-col cols="12 pa-1" v-show="item.tags.length">
                                            <v-chip-group>
                                                <v-chip small color="tag" text-color="white" v-for="(tag,index) in item.tags" :key="index">
                                                    {{tag}}
                                                </v-chip>
                                            </v-chip-group>
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                            </v-expansion-panels>
                        </v-col>
                    </v-row>
                    <v-row class="justify-center">
                        <v-col cols="12" sm="4" class="text-center">
                            <v-btn to="/topic">トピック探す</v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
        <b-loading :isLoading.sync="isLoading" />
    </v-container>
</template>

<script>
import moment from "moment";
import HomeHero from './HomeHero.vue'
import { mapState } from 'vuex'

export default {
    data () {
        return {
            topics: [],
        }
    },
    mounted() {
        this.getItems()
    },
    computed: mapState([ 'isLoading' ]),
    methods: {
        getItems() {
            this.$store.commit('startLoading')
            axios.get('/api/topic')
            .then(res => {
                this.topics = res.data
                this.$store.commit('homeInit',res.data)
                // console.log(res.data)
            }).catch(error => {
                alert('トピック情報が読み込めませんでした。')
            }).finally(resp => {
                this.$store.commit('finishLoading')
            })
        }
    },
    components: {
        HomeHero
    },
}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
.home {
  padding-bottom: 50px;
}
</style>