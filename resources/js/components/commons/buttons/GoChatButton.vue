<template>
    <v-btn color="primary" @click="onClick">
        メッセージを送信<i class="far fa-comment-dots"></i>
    </v-btn>
</template>

<script>
export default {
    props: ['id'],
    methods: {
        onClick() {
            this.$emit('goChat', this.id)
        }
    }
}
</script>