<template>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto"><h5>グループ一覧</h5></div>
                    <div class="col-auto form-inline">
                        <CreateUpdate @update="getItems"/>
                        <button class="btn btn-dark ml-2" @click="onBack">戻る</button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <table class="table table-hover">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>#</th>
                                <th>グループ名</th>
                                <th>作成日</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(group, index) in groups" :key="index" @click="onShow(group.id)">
                                <th>{{index+1}}</th>
                                <td>{{group.name}}</td>
                                <td>{{group.created_at | formatDate}}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <b-loading :isLoading.sync="isLoading" />
    </div>
</template>

<script>
import moment from "moment";
import CreateUpdate from './CreateUpdate.vue'
export default {
    components: { CreateUpdate },
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
            this.$router.push({ name: 'chat', params: {'group_id': group_id} }) 
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
