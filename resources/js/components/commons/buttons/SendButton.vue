<template>
    <v-btn color="primary" @click="onPush" :disabled="disabled">送信</v-btn>
</template>

<script>
export default {
    props: { 
        disabled: {
            type: Boolean,
            default: false,
        }
    },
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