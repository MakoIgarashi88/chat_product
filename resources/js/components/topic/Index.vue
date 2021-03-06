<template>
    <v-container>
        <v-card>
            <v-card-title>
                トピック一覧
                <v-spacer></v-spacer>
                <CreateModal @update="getItems"/>
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="キーワード" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="topics" :search="search" disable-sort calculate-widths>
                <template v-slot:[`item.image_name`]="{ item }">
                    <IconSm :src="item.image_name" class="px-1 py-2"/>
                </template>
                <template v-slot:[`item.name`]="{ item }">
                    <router-link :to="{ name: 'topic.show', params: { 'topic_id': item.id } }">
                        {{ item.name }}
                    </router-link>
                </template>
                <template v-slot:[`item.tags`]="{ item }" hide>
                    <v-chip-group column>
                        <v-chip
                            v-for="(tag,index) in item.tags" :key="index"
                            small
                            color="tag" 
                            text-color="white" 
                            >
                            {{tag | truncate }}
                        </v-chip>
                    </v-chip-group>
                </template>
            </v-data-table>
        </v-card>
        <b-loading :isLoading.sync="isLoading" />
    </v-container>
</template>

<script>
import moment from "moment";
import CreateModal from "../topic/CreateModal.vue";
import { mapState } from 'vuex'
export default {
    data () {
        return {
            headers: [
                { text: "", align: 'center', value: 'image_name'},
                { text: 'トピックタイトル', align: 'start', value: 'name'},
                { text: '詳細', align: 'start', value: 'detail'},
                { text: 'タグ', align: 'start', value: 'tags', class: "table-cell-sm"},
            ],
            topics: [],
            search: "",
        }
    },
    mounted() {
        this.getItems()
    },
    computed: mapState([ 'isLoading' ]),
    methods: {
        getItems () {
            this.$store.commit('startLoading')
            axios.get('/api/topic/list')
            .then(res => {
                this.topics = res.data
            }).catch(error => {
                alert('トピック情報が読み込めませんでした。')
            }).finally(res => {
                this.$store.commit('finishLoading')
            })
        }
    },
    components: {
        CreateModal,
    },
    filters: {
        truncate: function(value) {
            let length = 12
            let ommision = "..."
            if (value.length <= length) {
                return value
            }
            return value.substring(0, length) + ommision
        },
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>