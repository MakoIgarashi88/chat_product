<template>
    <loading
        :active.sync="isLoading"
        :is-full-page="false"
        :height="100"
        :width="100"
        loader="dots"
        color="#920d0d">
    </loading>
</template>

<script>
import Loading from 'vue-loading-overlay';
Vue.component('loading', Loading);
import 'vue-loading-overlay/dist/vue-loading.css';
export default {
    props: {
        isLoading: {
            type: Boolean, 
            default: false,
        }
    },
}
</script>