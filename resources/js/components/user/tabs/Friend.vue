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
                                            <IconSm :src="friend.image_name" />
                                        </v-list-item-avatar>
                                        <v-list-item-content class="pa-0">
                                            <v-row align="center">
                                                <v-col class="pa-0"><v-list-item v-text="friend.name"></v-list-item></v-col>
                                                <v-col class="text-end pa-0"><v-list-item><v-btn color="primary">メッセージを送信</v-btn></v-list-item></v-col>
                                            </v-row>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-divider v-if="index < friends.length - 1" :key="index"></v-divider>
                            </template>
                        </v-list-item-group>
                    </v-list>

                    <v-divider></v-divider>
                    <PageNation :page="page" :pageCount="pageCount" />
                </v-card>
            </v-col>
        </v-row>
    </v-card>
</template>

<script>
export default {
    props: ['friends'],
    data () {
        return {
            page: 1,
            pageCount: 5,
            selected: [2],
        }
    }
}
</script>

<style lang="scss" scoped>

</style>