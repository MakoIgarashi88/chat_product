<template>
    <div class="icon-sm">
        <v-skeleton-loader
            type="avatar"
            v-if="isLoading"
        ></v-skeleton-loader>
        <v-avatar v-else>
            <img :src="src_copy">
        </v-avatar>
    </div>
</template>

<script>
export default {
    props: {
        src: String,
        // isLoading: {
        //     type: Boolean, 
        //     default: true,
        //     required: true,
        // }
    },
    data() {
        return {
            src_copy: '/storage/images/default.png',
            isLoading: false,
        }
    },
    mounted () {
        if (this.src) this.src_copy = this.src
    }
}
</script>