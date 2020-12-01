<template>
    <v-card outlined>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <Detail />
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="8">
                <CommentList />
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
    }
  },
}
</script>

<style lang="scss" scoped>

</style>