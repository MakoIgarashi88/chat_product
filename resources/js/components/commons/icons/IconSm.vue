<template>
    <v-avatar>
        <img :src="src">
    </v-avatar>
</template>

<script>
export default {
    props: {
        src: {
            type: String,
            default: '/storage/images/yAyRulAQaz6f7DIV.png'
        }
    },
    mounted() {
        if (!this.src) {
            src = '/storage/images/yAyRulAQaz6f7DIV.png'
        }
    }
}
</script>