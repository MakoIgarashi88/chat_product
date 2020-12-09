<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
                            <template v-for="(friend, index) in mp_friends">
                                <v-list-item :key="friend.name">
                                    <template>
                                        <v-list-item-avatar>
                                            <IconSm :src="friend.image_name" />
                                        </v-list-item-avatar>
                                        <v-list-item-content class="pa-0">
                                            <v-row align="center">
                                                <v-col class="pa-0">
                                                    <v-list-item>
                                                        <router-link :to="{ name: 'friend.show', params: { 'user_id': friend.id } }">
                                                            {{friend.name}}
                                                        </router-link>
                                                    </v-list-item>
                                                </v-col>
                                                <v-col>
                                                    <v-list-item>
                                                        <PrivateChat :friend_id="friend.id"/>
                                                    </v-list-item>
                                                </v-col>
                                            </v-row>
                                        </v-list-item-content>
                                    </template>
                                </v-list-item>
                                <v-divider v-if="index < mp_friends.length - 1" :key="index"></v-divider>
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
import PrivateChat from '../../chat/private/Private.vue'
import { mapState } from 'vuex'
export default {
    data () {
        return {
            page: 1,
            pageCount: 5,
            selected: [2],
        }
    },
    computed: mapState([ 'mp_friends' ]),
    components: {
        PrivateChat
    }
}
</script>

<style lang="scss" scoped>

</style>