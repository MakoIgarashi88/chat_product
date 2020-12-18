<template>
    <div class="icon-sm">
        <!-- <v-skeleton-loader
            type="avatar"
            v-if="isLoading"
        ></v-skeleton-loader> -->
        <v-avatar>
            <img :src="src" v-if="src">
            <img :src="src_copy" v-else>
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
            isLoading: false,
        }
    },
}
</script>