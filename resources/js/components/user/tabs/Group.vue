<template>
    <div>
        <v-card v-if="!mp_groups.length">
            <v-row justify="center">
                <v-col cols="11">
                    <GroupCreate />
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="11">
                    <p>所属しているグループはありません。</p>
                    <p>まずは、気になる<router-link to="/topic">トピック</router-link>を探して、たくさんのユーザーに出会いましょう！</p>
                </v-col>
            </v-row>
        </v-card>
        <v-card v-else>
            <v-row justify="center">
                <v-col cols="11">
                    <GroupCreate />
                </v-col>
            </v-row>
            <v-row justify="center">
                <v-col cols="11">
                    <v-card outlined>
                        <v-list>                      
                            <v-list-item-group>
                                <template v-for="(group, index) in displayLists">
                                    <v-list-item :key="group.name">
                                        <template>
                                            <v-row class="pa-0">
                                                <v-col cols="auto" class="pa-0">
                                                    <v-list-item-avatar>
                                                        <v-badge overlap bordered content="6" color="error">
                                                            <IconSm :src="group.image_name"/>
                                                        </v-badge>
                                                    </v-list-item-avatar>
                                                </v-col>
                                                <v-col class="pa-0">
                                                    <v-row align="center">
                                                        <v-list-item-content class="pa-0">
                                                            <v-col class="pa-0">
                                                                <v-list-item-title>{{group.name}}</v-list-item-title>
                                                            </v-col>
                                                            <v-col cols="auto">
                                                                <v-list-item>
                                                                    <GoChatButton :id="group.id" @goChat="onRoot"/>
                                                                </v-list-item>
                                                            </v-col>
                                                        </v-list-item-content>
                                                    </v-row>
                                                </v-col>
                                            </v-row>
                                        </template>
                                    </v-list-item>
                                    <v-divider v-if="index < mp_groups.length - 1" :key="index"></v-divider>
                                </template>
                            </v-list-item-group>
                        </v-list>
                        <v-divider></v-divider>
    
                        <PageNation :pageCount="pageCount" v-show="pageCount>1" @getPage="pageChange"/>
                    </v-card>
                </v-col>
            </v-row>
        </v-card>
    </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
    data () {
        return {
            pageSize: 5,
            display: false,
            pageNumber: {},
        }
    },
    computed: {
        ...mapState([ 'mp_groups' ]),
        pageCount () {
            return Math.ceil(this.mp_groups.length / this.pageSize)
        },
        displayLists () {
            if (!this.display) {
                return this.mp_groups.slice(0,this.pageSize);
            }
            return this.mp_groups.slice(this.pageSize*(this.pageNumber-1),this.pageSize*(this.pageNumber));
        }
    },
    methods: {
        onRoot (group_id) {
            this.$router.push({ name: 'chat.group', params: {'group_id': group_id} }) 
        },
        pageChange: function (pageNumber) {
            this.pageNumber = pageNumber
            this.display = true
        }
    },
}
</script>

<style lang="scss" scoped>

</style>