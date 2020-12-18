<template>
    <div class="icon-lg">
        <v-avatar size="150">
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
            loading: false,
        }
    },
}
</script>