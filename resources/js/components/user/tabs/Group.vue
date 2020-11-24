
        // <div class="row">

        //     <div class="col-12 col-md-6">
        //         <div class="card mt-3">
        //             <div class="card-body">
        //                 <div class="row justify-content-between align-items-end mb-2">
        //                     <div class="col-auto"><h5>グループ一覧</h5></div>
        //                     <div class="col-auto"><GroupCreate @update="getItems"/></div>
        //                 </div>

        //                 <div class="row">
        //                     <div class="col">
        //                         <table class="table table-hover">
        //                             <thead class="bg-secondary text-white">
        //                                 <tr>
        //                                     <th>参加中グループ名</th>
        //                                     <th>作成日</th>
        //                                 </tr>
        //                             </thead>
        //                             <tbody>
        //                                 <tr v-for="(group,index) in paginate_groups" :key="index" @click="onGroupShow(group.id)">
        //                                     <td class="user-link">{{group.name}}</td>
        //                                     <td>{{group.created_at | formatDate}}</td>
        //                                 </tr>
        //                             </tbody>
        //                         </table>
        //                         <div class="d-flex justify-content-center">
        //                             <mg-paginate :data="groups" :count-per-page="5" @change="paginate_groups=$event" />
        //                         </div>
        //                     </div>
        //                 </div>
        //             </div>
        //         </div>
        //     </div>
        // </div>


<template>
    <v-card>
        <v-card-text>c</v-card-text>
    </v-card>
</template>

<script>
export default {
  data () {
    return {

    }
  }
}
</script>

<style lang="scss" scoped>

</style>