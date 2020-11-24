            // <div class="col-12 col-md-6">
            //     <div class="card mt-3">
            //         <div class="card-body">
            //             <div class="row justify-content-between align-items-end mb-2">
            //                 <div class="col-auto"><h5>友だち一覧</h5></div>
            //                 <div class="col-auto"><UserSerch @update="getItems"/></div>
            //             </div>

            //             <div class="row">
            //                 <div class="col">
            //                     <table class="table table-hover">
            //                         <thead class="bg-secondary text-white">
            //                             <tr>
            //                                 <th></th>
            //                                 <th>お名前</th>
            //                                 <th></th>
            //                             </tr>
            //                         </thead>
            //                         <tbody>
            //                             <tr v-for="(friend) in paginate_frinds" :key="friend.id">
            //                                 <td><img :src="friend.image_name" class="cut rounded-circle mt-2"></td>
            //                                 <td class="user-link" @click="onFriendShow(friend.id)">{{friend.name}}</td>
            //                                 <td><button class="btn btn-light" @click="onMessage(friend.id)"><i class="far fa-comment-dots"> {{friend.name}}にメッセージを送信</i></button></td>
            //                             </tr>
            //                         </tbody>
            //                     </table>
            //                     <div class="d-flex justify-content-center">
            //                         <mg-paginate :data="friends" :count-per-page="5" @change="paginate_frinds=$event" />
            //                     </div>
            //                 </div>
            //             </div>
            //         </div>
            //     </div>
            // </div>


<template>
    <v-card>
        <div>
            <v-data-table
                :headers="table_header"
                :items="table_items"
                :items-per-page="5"
                class="elevation-1"
                loading-text="hello"
                locale="ja"
            >
                <v-btn>aaa</v-btn>
            </v-data-table>
            <div class="text-center pt-2 pb-2">
                <v-pagination v-model="page" :length="pageCount" circle></v-pagination>
            </div>
        </div>
    </v-card>
</template>

<script>
export default {
  data () {
    return {
      page: 1,
      pageCount: 10,
      table_header: [
        {text:'名前',align:'center', value: 'name'},
        {text:'サンプル',align:'center', value: 'sample'},
        {text:'テスト',align:'center', value: 'test'}
      ],
      table_items: [
          {
              name: 'ueno',
              sample: 'first_sample',
              test: 'first_test',
          },
          {
              name: 'mako',
              sample: 'second_sample',
              test: 'second_test',
          },
      ]

    }
  }
}
</script>

<style lang="scss" scoped>

</style>