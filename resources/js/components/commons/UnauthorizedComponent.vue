<template>
<div class="container">
    <div class="card">
        <div class="card-body text-center">
            <div class="h3 text-danger mt-3"><i class="fas fa-exclamation-triangle"></i> 権限がありません。</div>
            <div class="mt-4">
                <button type="button" class="btn btn-lg btn-link" @click="onBack">戻る</button>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    methods: {
        onBack: function () {
            this.$router.replace({ path: '/' })
        }
    }
}
</script>
<style lang="scss" scoped>
</style>