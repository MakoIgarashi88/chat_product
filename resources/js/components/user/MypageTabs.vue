<template>
    <v-card>
        <v-tabs fixed-tabs background-color="secondary" dark v-model="tab">
            <v-tabs-slider color="accent"></v-tabs-slider>
            <v-tab>掲示板</v-tab>
            <v-tab>グループ</v-tab>
            <v-tab>友達</v-tab>
            <v-tab>トピック</v-tab>
        </v-tabs>

        <v-tabs-items v-model="tab">
            <!--掲示板-->
            <v-tab-item>
                <Board :isLoading.sync="isLoading"/>
            </v-tab-item>
            <!--グループ一覧-->
            <v-tab-item>
                <Group :groups="groups" :isLoading.sync="isLoading"/>
            </v-tab-item>
            <!--友だち一覧-->
            <v-tab-item>
                <Friend :friends="friends" />
            </v-tab-item>
            <!--トピック一覧-->
            <v-tab-item>
                <Topic />
            </v-tab-item>
        </v-tabs-items>
    </v-card>
</template>

<script>
import Board from './tabs/Board'
import Group from './tabs/Group'
import Friend from './tabs/Friend'
import Topic from './tabs/Topic'
export default {
    props: {
        isLoading: {
            type: Boolean,
            default: true,
            required: true,
        }
    },
	data () {
		return {
			dialog: false,
            tab: 0,
            groups: [],
            friends: [],
		}
    },
    mounted() {
        this.getItems()
    },
    methods: {
        getItems () {
            const api = axios.create()
            axios.all([
                api.get('/api/user'),
                api.get('/api/group'),
            ]).then(axios.spread((res,res2) => {
                this.friends = res.data.friends
                this.groups = res2.data
                // console.log(res2.data)
            })).catch(error => {
                alert(error)
            })
        }
    },
	components: {
		Board,
		Group,
		Friend,
		Topic,
	}
}
</script>

<style lang="scss">
// .v-data-table-header {
//     background-color: ;
// }
</style>