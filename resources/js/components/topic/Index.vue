<template>
    <v-container>
        <v-card>
            <v-card-title>
                トピック一覧
                <v-spacer></v-spacer>
                <CreateModal />
                <v-spacer></v-spacer>
                <v-text-field v-model="search" append-icon="mdi-magnify" label="キーワード" single-line hide-details></v-text-field>
            </v-card-title>
            <v-data-table :headers="headers" :items="desserts" :search="search"></v-data-table>
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
            ],
            search: "",
        }
    },
    methods: {
    },
    components: {
        CreateModal,
    }

}
</script>
<style lang="scss" scoped>
@import 'resources/sass/variables';
</style>