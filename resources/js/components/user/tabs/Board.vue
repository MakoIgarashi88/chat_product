<template>
    <v-card outlined>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <Detail :name="board.name" :detail="board.detail"/>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <CommentList :page="page" :pageCount="pageCount"/>
                <!-- <CommentList :page="page" :pageCount="pageCount" :isLoading.sync="isLoading"/> -->
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <MessageForm />
            </v-col>
        </v-row>
    </v-card>
    
</template>

<script>
export default {
  data () {
    return {
        board: {
            name: 'こんにちは',
            detail: '自由に書き込んでください',
        },
        page: 1,
        pageCount: 3,
    }
  },
}
</script>

<style lang="scss" scoped>

</style>