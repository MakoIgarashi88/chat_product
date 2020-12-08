<template>
    <v-container>
        <v-row class="justify-center">
            <v-col cols="12">
                <section class="home">
                    <HomeHero/>
                </section>
                <v-card outlined>
                    <v-row class="justify-center">
                        <v-col cols="8">
                            <v-card outlined>
                                <v-card-title class="justify-center pa-3">
                                    人気トピック
                                </v-card-title>
                            </v-card>
                        </v-col>
                        <v-col cols="11">
                            <v-expansion-panels>
                            <v-expansion-panel v-for="(item,index) in topics" :key="item.name">
                                <v-expansion-panel-header>
                                    <div>{{index+1}}</div>
                                    <div>
                                        <router-link :to="{ name: 'topic.show', params: { 'topic_id': item.id } }">
                                            {{item.name}}
                                        </router-link>
                                    </div>
                                    <v-spacer></v-spacer>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-row>
                                        <v-col cols="12">
                                            {{item.detail}}
                                        </v-col>
                                        <v-col cols="12">
                                            <v-chip class="ma-2" color="green" text-color="white">
                                                アニメ
                                            </v-chip>
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