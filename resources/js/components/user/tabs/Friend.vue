<template>
    <v-card>
        <v-row justify="center">
            <v-col cols="11">
                <v-card outlined>
                    <v-list two-line>
                        <v-list-item-group v-model="selected" active-class="pink--text">
                            <template v-for="(friend, index) in displayLists">
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
                                                        <GoChatButton :id="friend.id" @goChat="onRoot"/>
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
                    <PageNation :pageCount="pageCount" v-show="pageCount>1" @getPage="pageChange"/>
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
            pageSize: 5,
            selected: [2],
            displayLists: [],
        }
    },
    computed: {
        ...mapState([ 'mp_friends' ]),
        pageCount () {
            return Math.ceil(this.mp_friends.length / this.pageSize)
        },
    },
    methods: {
        onRoot (friend_id) {
            this.$router.push({ name: 'chat.private', params: {'friend_id': friend_id} }) 
        },
        pageChange: function (pageNumber) {
            // pageSize: 5
            // pageNumber: 1
            // this.displayLists = this.mp_friends.splice(this.pageSize*(pageNumber-1), this.pageSize)
            this.displayLists = this.mp_friends.slice(this.pageSize*(pageNumber-1),this.pageSize*(pageNumber));
        }
    },
    mounted () {
        this.displayLists = this.mp_friends.slice(0,this.pageSize);
    },
}
</script>

<style lang="scss" scoped>

</style>