<template>
<div>
    <transition name="view" mode="out-in">
        <router-view />
    </transition>
</div>
</template>

<script>
export default {
    mounted () {
        if (window.Laravel.api_token == "Unauthorized") {
            alert("ゲストユーザーです。\nチャット機能を利用する場合は、ログインしてください。")
        }
    }
}
</script>

<style scoped>
</style>