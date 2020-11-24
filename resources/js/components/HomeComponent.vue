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
                            <v-expansion-panels accordion>
                            <v-expansion-panel v-for="(item,index) in desserts" :key="item.name">
                                <v-expansion-panel-header>
                                    <div>{{index+1}}</div>
                                    <div>{{item.name}}</div>
                                    <v-spacer></v-spacer>
                                </v-expansion-panel-header>
                                <v-expansion-panel-content>
                                    <v-row>
                                        <v-col cols="12">
                                            {{item.detail}}
                                        </v-col>
                                        <v-col cols="12">
                                            tags
                                        </v-col>
                                    </v-row>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                            </v-expansion-panels>
                        </v-col>
                        <!-- <v-col cols="11">
                            <v-card outlined>
                                <v-simple-table fixed-header height="300px">
                                    <template v-slot:default>
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                topic_name
                                            </th>
                                            <th class="text-center">
                                                detail
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in desserts" :key="item.name">
                                            <td class="text-center">{{ item.name }}</td>
                                            <td class="text-center">{{ item.detail}}</td>
                                        </tr>
                                    </tbody>
                                    </template>
                                </v-simple-table>
                            </v-card>
                        </v-col> -->
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
export default {
    components: {
        HomeHero
    },
    data () {
        return {
            isLoading: false,
            desserts: [
                {
                    name: "暇人",
                    detail: "暇すぎちょっとだけはなそ",
                },
                {
                    name: "しのぶさんが好き",
                    detail: "しのぶさんのためだけのトピック",
                },
                {
                    name: "まじ病み",
                    detail: "誹謗中傷しないでください",
                },
                {
                    name: "バスケが好き",
                    detail: "サークル感覚ではなく本気でバスケが好きな人はなそー！",
                },
                {
                    name: "JK会",
                    detail: "参加条件：JK（女子高校生）であること！",
                },
            ]
        }
    }
}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
.home {
  padding-bottom: 50px;
}
</style>