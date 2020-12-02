<template>
    <div class="text-center pt-2 pb-2" v-show="page && pageCount">
        <v-pagination v-model="page" :length="pageCount" circle></v-pagination>
    </div>
</template>

<script>
export default {
    props: {
        page: {
            type: Number,
        },
        pageCount: {
            type: Number,
        }
    },
    data () {
        return {
        }
    },
}
</script>