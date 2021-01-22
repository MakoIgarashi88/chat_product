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
            <v-data-table :headers="headers" :items="topics" :search="search" disable-sort>
                <template v-slot:[`item.image_name`]="{ item }">
                    <v-row>
                        <v-col class="px-1 py-2">
                            <IconSm :src="item.image_name" />
                        </v-col>
                    </v-row>
                </template>
                <template v-slot:[`item.name`]="{ item }">
                    <router-link :to="{ name: 'topic.show', params: { 'topic_id': item.id } }">
                        {{ item.name }}
                    </router-link>
                </template>
                <template v-slot:[`item.tags`]="{ item }" hide>
                    <v-chip-group>
                        <v-chip
                            v-for="(tag,index) in item.tags" :key="index"
                            small
                            color="tag" 
                            text-color="white" 
                            >
                            {{tag}}
                        </v-chip>
                    </v-chip-group>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import moment from "moment";
import CreateModal from "../topic/CreateModal.vue";
export default {
    data () {
        return {
            headers: [
                { text: "", align: 'center', sortable: false, value: 'image_name',},
                { text: 'トピックタイトル', align: 'start', sortable: false, value: 'name',},
                { text: '詳細', align: 'start', value: 'detail'},
                { text: 'タグ', align: 'start', value: 'tags'},
            ],
            topics: [],
            search: "",
        }
    },
    mounted() {
        this.getItems()
    },
    methods: {
        getItems () {
            axios.get('/api/topic/')
            .then(res => {
                this.topics = res.data
                console.log(this.topics)
            }).catch(error => {
                alert('トピック情報が読み込めませんでした。')
            })
        }
    },
    components: {
        CreateModal,
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>