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
                        <v-list-item-content>
                            <v-list-item-title>{{message.user.name}}</v-list-item-title>
                            <v-list-item-subtitle>{{message.body}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
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
                        <v-list-item-content>
                            <v-list-item-title>{{message.user.name}}</v-list-item-title>
                            <v-list-item-subtitle>{{message.body}}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
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
        reverseItems() {
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
        }
    },
    mounted () {
        // this.displayLists = this.messages.slice(0,this.pageSize);
    },
}
</script>