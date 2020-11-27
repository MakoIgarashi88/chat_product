<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card outlined>
                    <v-card-title>
                        <v-row class="justify-space-between">
                            <v-col cols="auto">
                                {{user.name}}のページ
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-col class="text-right"><!-- v-show="!friend" -->
                                <v-btn>友達申請</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-title>
                    <v-card-text>
                        <v-row>
                            <!--サムネイル-->
                            <v-col cols="12" sm="3" class="text-center">
                                <img class="cut rounded-circle" :src="user.image_name">
                            </v-col>
                            <v-col cols="12" sm="9">
                                <!--ニックネーム-->
                                <v-row justify="center" justify-sm="start">
                                    <v-col cols="auto">
                                    <v-text-field
                                        label="ニックネーム"
                                        :placeholder="user.nickname"
                                        filled
                                        rounded
                                        dense
                                        disabled
                                    />
                                    </v-col>
                                </v-row>
                                <!--自己紹介欄-->
                                <v-row>
                                    <v-col cols="12" sm="auto">
                                    <v-text-field
                                        label="自己紹介"
                                        :placeholder="user.detail"
                                        filled
                                        rounded
                                        dense
                                        disabled
                                    />
                                    </v-col>
                                </v-row>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
                <v-row class="pt-2">
                    <v-col>
                        <Board />
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import moment from "moment";
import Board from './tabs/Board'
export default {
    data () {
        return {
            user: {
                id: 1,
                name: 'mako',
                nickname: 'まこ',
                image_id: 24,
                image_name: 'storage/images/Z4Wm6pZfqcoD6Hu1.png',
                detail: "こんにちは！",
            },
            friends: [],
            paginate_frinds: [],
            is_edit: false,
            groups: [],
            paginate_groups: [],
            isLoading: false,
            invites: [],
            upload_image: null,
        }
    },
    components: {
        Board,
    }
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/variables';
.cut {
    width: 7rem;
    height: 7rem;
    object-fit: contain;
    border: 1px solid $primary;
}
</style>