<template>
    <v-card outlined>
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
        }
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