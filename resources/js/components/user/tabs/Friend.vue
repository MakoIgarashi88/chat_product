<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
                            <template v-for="(friend, index) in friends">
                                <v-list-item :key="friend.name">
                                    <template>
                                        <v-list-item-avatar>
                                            <img :src="friend.image">
                                        </v-list-item-avatar>
                                        <v-list-item-content>
                                            <v-list-item-title v-text="friend.name"></v-list-item-title>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-divider v-if="index < friends.length - 1" :key="index"></v-divider>
                            </template>
                        </v-list-item-group>
                    </v-list>

                    <div class="text-center pt-2 pb-2">
                        <v-pagination v-model="page" :length="pageCount" circle></v-pagination>
                    </div>
                </v-card>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
export default {
  data () {
    return {
      page: 1,
      pageCount: 5,
      selected: [2],
      friends: [
          {
              name: 'ueno',
              image: '/storage/images/QPZUNpPqoz4RPHY2.png',
          },
          {
              name: 'mako',
              image: '/storage/images/QPZUNpPqoz4RPHY2.png',
          },
      ]
    }
  }
}
</script>

<style lang="scss" scoped>

</style>