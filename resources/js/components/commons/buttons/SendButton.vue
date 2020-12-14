<template>
    <v-btn color="primary" @click="onPush">送信</v-btn>
</template>

<script>
export default {
    data () {
        return {
        }
    },
    methods: {
        onPush() {
            this.$emit('submit')
        }
    }
}
</script>