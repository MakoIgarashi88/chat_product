<template>
<div>
    <transition name="fade" mode="out-in">
        <router-view class="main" />
    </transition>
</div>
</template>

<script>
export default {
    mounted () {
        // if (window.Laravel.api_token == "Unauthorized") {
        //     alert("ゲストユーザーです。\nチャット機能を利用する場合は、ログインしてください。")
        // }
    }
}
</script>

<style lang="scss" scoped>
.main {
    margin-top: 3rem;
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>