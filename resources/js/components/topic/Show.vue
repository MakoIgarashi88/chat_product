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
                    <IconLg :src="image" />
                </v-col>
                <v-col cols="12" sm="8">
                    <Detail :name="topic.name" :detail="topic.detail" />
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
    props: ['topic_id'],
    data () {
        return {
            topic: {},
            image: '/storage/images/QPZUNpPqoz4RPHY2.png',

            page: 0,
            pageCount: 0,
        }
    },
    mounted() {
        this.getItems()
    },
    methods: {
        getItems() {
            axios.get('/api/topic/' + this.topic_id)
            .then(res => {
                console.log(res.data)
                this.topic = res.data
            }).catch(error => {
                alert('トピック情報が読み込めませんでした。')
            })
        }
    },
}
</script>

<style lang="scss" scoped>

</style>