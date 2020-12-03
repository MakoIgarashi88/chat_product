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
        src: {
            type: String,
            default: '/storage/images/yAyRulAQaz6f7DIV.png'
        }
    },
    data() {
        return {
            src_copy: '/storage/images/yAyRulAQaz6f7DIV.png',
            is_init: false,
            loading: true,
        }
    },
    mounted () {
        this.is_init = true
    },
    watch: {
        src: {
            handler () {
                if (this.src) this.src_copy = this.src
                if (this.is_init) this.loading = false
            },
            immediate: true
        }
    },
}
</script>