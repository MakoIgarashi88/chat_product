<template>
    <v-btn color="primary" @click="goHome"><i class="fas fa-home"></i></v-btn>
</template>

<script>
export default {
    methods: {
        goHome: function () {
            this.$router.push({ name: 'user' })
        }
    }
}
</script>