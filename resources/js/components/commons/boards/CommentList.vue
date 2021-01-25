<template>
    <div>
        <v-btn @click="is_old=!is_old" color="primary">
            <div v-if="is_old">新しい順</div>
            <div v-else>古い順</div>
        </v-btn>
        <v-card outlined v-if="is_old">
            <v-list>
                <template v-for="(message, index) in displayLists">
                    <v-list-item :key="index">
                        <v-list-item-avatar>
                            <IconSm :src="message.user.image_name" />
                        </v-list-item-avatar>
                        <v-list-item-content class="pa-1">
                            <v-row class="justify-space-between">
                                <v-col class="py-1">
                                    <div v-if="message.is_myself">
                                        <v-list-item-title>{{message.user.nickname}}</v-list-item-title>
                                    </div>
                                    <div v-else>
                                        <router-link :to="{ name: 'friend.show', params: { 'user_id': message.user.id } }">
                                            <v-list-item-title>{{message.user.nickname}}</v-list-item-title>
                                        </router-link>
                                    </div>
                                </v-col>
                                <v-col class="py-1 text-right" v-show="message.is_myself">
                                    <v-btn depressed icon x-small @click="commentDel(message)"><i class="fas fa-times"></i></v-btn>
                                </v-col>
                            </v-row>
                            <v-list-item-subtitle>{{message.created_at}}</v-list-item-subtitle>
                            <v-list-item-title>{{message.body}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider :key="'key'+index"></v-divider>
                </template>
            </v-list>
            <PageNation :pageCount="pageCount" v-show="pageCount>1" @getPage="pageChange"/>
        </v-card>
        <v-card outlined v-else>
            <v-list>
                <template v-for="(message, index) in reverseItems">
                    <v-list-item :key="index">
                        <v-list-item-avatar>
                            <IconSm :src="message.user.image_name" />
                        </v-list-item-avatar>
                        <v-list-item-content class="pa-1">
                            <v-row class="justify-space-between">
                                <v-col class="py-1">
                                    <div v-if="message.is_myself">
                                        <v-list-item-title>{{message.user.nickname}}</v-list-item-title>
                                    </div>
                                    <div v-else>
                                        <router-link :to="{ name: 'friend.show', params: { 'user_id': message.user.id } }">
                                            <v-list-item-title>{{message.user.nickname}}</v-list-item-title>
                                        </router-link>
                                    </div>
                                </v-col>
                                <v-col class="py-1 text-right" v-show="message.is_myself">
                                    <v-btn depressed icon x-small @click="commentDel(message)"><i class="fas fa-times"></i></v-btn>
                                </v-col>
                            </v-row>
                            <v-list-item-subtitle>{{message.created_at}}</v-list-item-subtitle>
                            <v-list-item-title>{{message.body}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider :key="'key'+index"></v-divider>
                </template>
            </v-list>
            <PageNation :pageCount="pageCount" v-show="pageCount>1" @getPage="pageChange"/>
        </v-card>
    </div>
</template>

<script>
export default {
    props: {
        pageSize: {
            type: Number,
        },
        messages: {
            type: Array,
        },
        place: {
            type: String,
        }
    },
    data () {
        return {
            display: false,
            pageNumber: {},
            is_old: false,
        }
    },
    computed: {
        pageCount () {
            return Math.ceil(this.messages.length / this.pageSize)
        },
        displayLists () {
            if (!this.display) {
                return this.messages.slice(0,this.pageSize);
            }
            return this.messages.slice(this.pageSize*(this.pageNumber-1),this.pageSize*(this.pageNumber));
        },
        reverseItems () {
            this.items = this.messages.slice().reverse();
            if (!this.display) {
                return this.items.slice(0,this.pageSize);
            }
            return this.items.slice(this.pageSize*(this.pageNumber-1),this.pageSize*(this.pageNumber));
            console.log(this.items)
        },
    },
    methods: {
        pageChange: function (pageNumber) {
            this.pageNumber = pageNumber
            this.display = true
            // this.displayLists = this.messages.slice(this.pageSize*(pageNumber-1),this.pageSize*(pageNumber));
        },
        commentDel (message) {
            if (confirm("本当に削除しますか")) {
                if (this.place=='board') {
                    // console.log('board');
                    // console.log(message.id);
                    axios.delete('/api/board/message/' + message.id)
                    .then(res => {
                        this.$store.commit('boardMessageRemove', message.id)
                    })
                    .catch(error => {
                        alert('削除に失敗しました。')
                    })
                } else {
                    // console.log('topic');
                    // console.log(message.id);
                    axios.delete('/api/topic/message/' + message.id)
                    .then(res => {
                        this.$store.commit('topicMessageRemove', message.id)
                    })
                    .catch(error => {
                        alert('削除に失敗しました。')
                    })
                }                
            } else {
                console.log('bbb');
            }
        }
    },
}
</script>