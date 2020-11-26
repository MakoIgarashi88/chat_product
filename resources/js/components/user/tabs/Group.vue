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
                                        <v-row>
                                            <v-col cols="2" class="text-center">
                                                <v-badge overlap bordered content="6" color="error">
                                                    <v-avatar color="grey lighten-3">
                                                        <img :src="friend.image">
                                                    </v-avatar>
                                                </v-badge>
                                            </v-col>
                                            <v-col cols="10">
                                                <v-list-item-content>
                                                    <v-list-item-title v-text="friend.name"></v-list-item-title>
                                                </v-list-item-content>
                                            </v-col>
                                        </v-row>
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
        <v-card-text>

            <!-- this is second tabs -->
            <v-dialog v-model="dialog" width="500">
                <template v-slot:activator="{ on, attr }">
                    <v-btn v-bind="attr" v-on="on">open</v-btn>
                </template>
                <v-card>
                    <v-card-title>testing</v-card-title>
                    <v-card-text>hello</v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        text
                        @click="dialog = false"
                    >
                        I accept
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data () {
        return {
            page: 1,
            pageCount: 5,
            dialog: false,
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