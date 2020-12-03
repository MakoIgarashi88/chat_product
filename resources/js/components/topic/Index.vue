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
            <v-data-table :headers="headers" :items="topics" :search="search">
                <template v-slot:[`item.name`]="{ item }">
                    <router-link class="router-link" color="primary" :to="'/topic/' + item.id">{{ item.name }}</router-link>
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
                { text: 'トピックタイトル', align: 'center', sortable: false, value: 'name',},
                { text: '詳細', align: 'start', value: 'detail'},
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
            console.log('update')
            axios.get('/api/topic/')
            .then(res => {
                this.topics = res.data
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