<template>
    <div class="icon-lg">
        <v-skeleton-loader
            type="avatar"
            v-if="loading"
        ></v-skeleton-loader>
        <v-avatar size="150" v-else>
            <img :src="src_copy">
        </v-avatar>
    </div>
</template>

<script>
export default {
    props: {
        src: String,
    },
    data() {
        return {
            src_copy: '/storage/images/default.png',
            is_init: false,
            loading: false,
        }
    },
    mounted () {
        this.is_init = true
    },
    watch: {
        src () {
            if (this.src) this.src_copy = this.src
        }
    },
}
</script>