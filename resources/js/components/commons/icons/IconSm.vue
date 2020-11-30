<template>
    <v-avatar>
        <img :src="src_copy">
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
    data() {
        return {
            src_copy: '/storage/images/yAyRulAQaz6f7DIV.png',
        }
    },
    mounted() {
        if (this.src) this.src_copy = this.src
    }
}
</script>