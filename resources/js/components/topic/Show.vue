<template>
    <v-container>
        <v-card outlined>
            <v-row>
                <v-col>
                    <div class="pa-5"><BackButton /></div>
                </v-col>
            </v-row>
            <v-row justify="center" align="center">
                <v-col cols="12" sm="3" class="text-center">
                    <IconLg :src="user.image" />
                </v-col>
                <v-col cols="12" sm="8">
                    <Detail />
                </v-col>
            </v-row>
        </v-card>
        <v-card outlined class="mt-2">
            <v-row justify="center">
                <v-col cols="12" sm="8">
                    <CommentList :page="page" :pageCount="pageCount" />
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="12" sm="8">
                    <MessageForm />
                </v-col>
            </v-row>
        </v-card>
    </v-container>
</template>

<script>
export default {
  data () {
    return {
        // topic: {
        //     name: '暇人',
        //     detail: '適当に話しましょう',
        // },
        user: {
            user_id: 4,
            user_name: 'チャンミン',
            image: '/storage/images/QPZUNpPqoz4RPHY2.png',
        },
        page: 0,
        pageCount: 0,
    }
  },
}
</script>

<style lang="scss" scoped>

</style>