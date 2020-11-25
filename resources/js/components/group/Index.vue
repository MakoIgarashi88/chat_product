<template>
    <v-container>
        <v-card>
            <v-card-title>
                トピック一覧
            </v-card-title>
            aaa
        </v-card>
        <b-loading :isLoading.sync="isLoading" />
    </v-container>
</template>

<script>
import moment from "moment";
export default {
    data () {
        return {
            groups: [],
            isLoading: false,
        }
    },
    mounted () {
        this.getItems()
    },
    methods: {
        getItems () {
            this.isLoading = true
            axios.get('/api/group')
            .then(resp => {
                this.groups = resp.data
            }).catch(error => {
                alert(error)
            }).finally(resp => {
                this.isLoading = false
            })
        },
        onShow (group_id) {
            this.$router.push({ name: 'chat.group', params: {'group_id': group_id} }) 
        },
        onBack () {
            this.$router.push({ name: 'home' })
        },
    },
    filters: {
        formatDate (date) {
            return moment(date).format('YYYY年MM月DD日 HH時mm分')
        }
    },

}
</script>
