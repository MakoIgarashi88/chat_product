<template>
    <v-card outlined>
        <v-list>
            <template v-for="(message, index) in messages">
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
        <PageNation :page="page" :pageCount="pageCount" />
    </v-card>
</template>

<script>
export default {
    props: {
        page: {
            type: Number,
        },
        pageCount: {
            type: Number,
        },
        messages: {
            type: Array,
        }
    },
    data () {
        return {

        }
    }
}
</script>