<template>
    <v-card outlined>
        <v-row justify="center">
            <v-col cols="12" md="8">
                <Detail />
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" md="8">
                <CommentList />
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <Message />
            </v-col>
        </v-row>
    </v-card>
    
</template>

<script>
import Detail from '../../commons/Detail.vue'
import CommentList from '../../commons/CommentList.vue'
import Message from '../../commons/MessageForm.vue'
export default {
  data () {
    return {
        board: {
            name: 'こんにちは',
            detail: '自由に書き込んでください',
        },
    }
  },
  components: {
    Detail,
    CommentList,
    Message
  }
}
</script>

<style lang="scss" scoped>

</style>